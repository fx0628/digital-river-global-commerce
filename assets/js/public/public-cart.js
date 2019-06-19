/* global drExpressOptions, iFrameResize */
/* eslint-disable no-alert, no-console */

jQuery(document).ready(($) => {
    const apiBaseUrl = 'https://api.digitalriver.com/v1/shoppers';

    // Very basic throttle function,
    // does not store calls white in limit period
    const throttle = (func, limit) => {
        let inThrottle

        return function() {
          const args = arguments
          const context = this

          if (!inThrottle) {
            func.apply(context, args)
            inThrottle = true
            setTimeout(() => inThrottle = false, limit)
          }
        }
    }

    $('body').on('click', '.dr-prd-del', (e) => {
        e.preventDefault();

        const $this = $(e.target);
        const lineItemId = $this.closest('.dr-product').data('line-item-id');

        $.ajax({
            type: 'DELETE',
            headers: {
                "Accept": "application/json"
            },
            url: (() => {
                let url = `${apiBaseUrl}/me/carts/active/line-items/${lineItemId}?`;
                url += `&token=${drExpressOptions.accessToken}`
                return url;
            })(),
            success: (data, textStatus, xhr) => {
                if ( xhr.status === 204 ) {
                    $(`.dr-product[data-line-item-id="${lineItemId}"]`).remove();
                    fetchFreshCart();
                }
                // TODO: On Error give feedback
            },
            error: (jqXHR) => {
                console.log(jqXHR);
                 // On Error give feedback
            }
        });
    });

    $('body').on('click', 'span.dr-pd-cart-qty-plus, span.dr-pd-cart-qty-minus', throttle(setProductQty, 200));

    function setProductQty(e) {
        // Get current quantity values
        const $this = $(e.target);
        const lineItemId = $this.closest('.dr-product').data('line-item-id');
        const $qty = $this.siblings('.product-qty-number:first');
        const val = parseInt($qty.val(), 10);
        const max = parseInt($qty.attr('max'), 10);
        const min = parseInt($qty.attr('min'), 10);
        const step = parseInt($qty.attr('step'), 10);
        const initialVal = $qty.val();

        if (val) {
            // Change the value if plus or minus
            if ($(e.currentTarget).is('.dr-pd-cart-qty-plus')) {
                if (max && (max <= val)) {
                    $qty.val(max);
                } else {
                    $qty.val(val + step);
                }
            } else if ($(e.currentTarget).is('.dr-pd-cart-qty-minus')) {
                if (min && (min >= val)) {
                    $qty.val(min);
                } else if (val > 1) {
                    $qty.val(val - step);
                }
            }
        } else {
            $qty.val('1');
        }

        let params = {
            'token'               : drExpressOptions.accessToken,
            'action'              : 'update',
            'quantity'            : $qty.val(),
            'expand'              : 'all',
            'fields'              : null
        }

        $.ajax({
            type: 'POST',
            headers: {
                "Accept": "application/json"
            },
            url: (() => {
                let url = `${apiBaseUrl}/me/carts/active/line-items/${lineItemId}?${$.param(params)}`;
                return url;
            })(),
            success: (data, textStatus, xhr) => {
                if (xhr.status === 200) {
                    let { formattedListPriceWithQuantity, formattedSalePriceWithQuantity } = data.lineItem.pricing;
                    $(`span#${lineItemId}.sale-price`).text(formattedSalePriceWithQuantity);
                    $(`span#${lineItemId}.regular-price`).text(formattedListPriceWithQuantity);

                    fetchFreshCart();
                }
            },
            error: (jqXHR) => {
                // TODO: Handle errors gracefully | revery back
                console.log(jqXHR);
            }
        });
    }

    function fetchFreshCart() {
        $.ajax({
            type: 'GET',
            headers: {
                "Accept": "application/json"
            },
            url: (() => {
                let url = `${apiBaseUrl}/me/carts/active?`;
                url += `&expand=all`
                url += `&token=${drExpressOptions.accessToken}`
                return url;
            })(),
            success: (data) => {
                renderCartProduct(data);
                displayMiniCart(data.cart);
            },
            error: (jqXHR) => {
                console.log(jqXHR);
            }
        });
    }

    function renderCartProduct(data){
      $('.dr-cart__products').html("");
      console.log(data.cart);
      $.each(data.cart.lineItems.lineItem, function( index, lineitem ) {
        let permalink = '';
        $.ajax({
          type: 'POST',
          async: false,
          url: drExpressOptions.ajaxUrl,
          data: {
            action: 'get_permalink',
            productID: lineitem.product.id
          },
          success: (response) => {
            permalink = response;
            let lineItemHTML = `
            <div data-line-item-id="${lineitem.id}" class="dr-product">
              <div class="dr-product-content">
                  <div class="dr-product__img" style="background-image: url(${lineitem.product.thumbnailImage})"></div>
                  <div class="dr-product__info">
                      <a class="product-name" href="${permalink}">${lineitem.product.displayName}</a>
                      <div class="product-sku">
                          <span>Product </span>
                          <span>#${lineitem.product.id}</span>
                      </div>
                      <div class="product-qty">
                          <span class="qty-text">Qty ${lineitem.quantity}</span>
                          <span class="dr-pd-cart-qty-minus value-button-decrease"></span>
                          <input type="number" class="product-qty-number" step="1" min="1" max="999" value="${lineitem.quantity}" maxlength="5" size="2" pattern="[0-9]*" inputmode="numeric" readonly="true">
                          <span class="dr-pd-cart-qty-plus value-button-increase"></span>
                      </div>
                  </div>
              </div>
              <div class="dr-product__price">
                  <button class="dr-prd-del remove-icon"></button>
                  <span class="sale-price">${lineitem.pricing.formattedSalePriceWithQuantity}</span>
                  <span class="regular-price">${lineitem.pricing.formattedListPriceWithQuantity}</span>
              </div>
            </div>
            `;
            $('.dr-cart__products').append(lineItemHTML);
          }
        });
      });
      let { formattedShippingAndHandling, formattedSubtotal } = data.cart.pricing;
      $('div.dr-summary__shipping .shipping-value').text(formattedShippingAndHandling);
      $('div.dr-summary__subtotal .subtotal-value').text(formattedSubtotal);
      if ($('.dr-cart__products').children().length <= 0) {
        $('.dr-cart__products').text('Your cart is empty!');
        $('#cart-estimate').hide();
      }

    }

    $('.dr-currency-select').on('change', function(e) {
        e.preventDefault();

        let data = {
            currency: e.target.value,
            locale: $(this).find('option:selected').attr('data-locale')
        };

        $.ajax({
            type: 'POST',
            url: (() => {
                let url = `${apiBaseUrl}/me?`;
                url += `format=json`
                url += `&token=${drExpressOptions.accessToken}`
                url += `&currency=${data.currency}`
                url += `&locale=${data.locale}`
                return url;
            })(),
            success: (data, textStatus, xhr) => {
                if (xhr.status === 204) {
                    location.reload();
                }
            },
            error: (jqXHR) => {
                reject(jqXHR);
            }
        });
    });

    function displayMiniCart(cart) {

        if ( cart === undefined || cart === null ) {
            return;
        }

        const $display = $('.dr-minicart-display');
        const $body = $('<div class="dr-minicart-body"></div>');
        const $footer = $('<div class="dr-minicart-footer"></div>');

        let lineItems = (cart.lineItems && cart.lineItems.lineItem) ? cart.lineItems.lineItem : [];

        $('.dr-minicart-count').text(cart.totalItemsInCart);
        $('.dr-minicart-header').siblings().remove();

        if (!lineItems.length) {
            const emptyMsg = '<p class="dr-minicart-empty-msg">Your shopping cart is currently empty.</p>';
            $body.append(emptyMsg);
            $display.append($body);
        } else {
            let miniCartLineItems = '<ul class="dr-minicart-list">';
            const miniCartSubtotal = `<p class="dr-minicart-subtotal"><label>Sub-Total</label><span>${cart.pricing.formattedSubtotal}</span></p>`;
            const miniCartViewCartBtn = `<a class="dr-btn" id="dr-minicart-view-cart-btn" href="${drExpressOptions.cartUrl}">View Cart</a>`;
            const miniCartCheckoutBtn = `<a class="dr-btn" id="dr-minicart-checkout-btn" href="${drExpressOptions.cartUrl}">Checkout</a>`;

            lineItems.forEach((li) => {
                const productId = li.product.uri.replace(`${apiBaseUrl}/me/products/`, '');
                const listPrice = Number(li.pricing.listPriceWithQuantity.value);
                const salePrice = Number(li.pricing.salePriceWithQuantity.value);
                const formattedSalePrice = li.pricing.formattedSalePriceWithQuantity;
                let priceContent = '';

                if (listPrice > salePrice) {
                    priceContent = `<del class="dr-strike-price">${listPrice}</del><span class="dr-sale-price">${formattedSalePrice}</span>`;
                } else {
                    priceContent = formattedSalePrice;
                }

                const miniCartLineItem = `
                <li class="dr-minicart-item clearfix">
                    <div class="dr-minicart-item-thumbnail">
                        <img src="${li.product.thumbnailImage}" alt="${li.product.displayName}" />
                    </div>
                    <div class="dr-minicart-item-info" data-product-id="${productId}">
                        <span class="dr-minicart-item-title">${li.product.displayName}</span>
                        <span class="dr-minicart-item-qty">Qty.${li.quantity}</span>
                        <p class="dr-pd-price dr-minicart-item-price">${priceContent}</p>
                    </div>
                    <a href="#" class="dr-minicart-item-remove-btn" aria-label="Remove" data-line-item-id="${li.id}">Remove</a>
                </li>`;
                miniCartLineItems += miniCartLineItem;
            });
            miniCartLineItems += '</ul>';
            $body.append(miniCartLineItems, miniCartSubtotal);
            $footer.append(miniCartViewCartBtn, miniCartCheckoutBtn);
            $display.append($body, $footer);
        }
    }
    //init cart via JS
    fetchFreshCart();
});

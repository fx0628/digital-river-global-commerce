<?php
/**
 * Provide a publidr-facing view for the plugin
 *
 * This file is used to markup the publidr-facing aspects of the plugin.
 *
 * @link       https://www.digitalriver.com
 * @since      1.0.0
 *
 * @package    Digital_River_Global_Commerce
 * @subpackage Digital_River_Global_Commerce/public/partials
 */
?>

<?php
$subtotal_items = $cart['cart']['totalItemsInCart'];
$subtotal_items_text = $cart['cart']['totalItemsInCart'] > 1 ? __( 'items', 'digital-river-global-commerce' ) : __( 'item', 'digital-river-global-commerce' );
$subtotal_value = $cart['cart']['pricing']['formattedSubtotal'];
$estimated_tax_value = $cart['cart']['pricing']['formattedTax'];
$shipping_price_value = $cart['cart']['pricing']['shippingAndHandling']['value'] === 0 ? __( 'FREE', 'digital-river-global-commerce' ) : $cart['cart']['pricing']['formattedShippingAndHandling'];
$discount = $cart['cart']['pricing']['discount']['value'];
$formatted_discount = $cart['cart']['pricing']['formattedDiscount'];
$total_value = $cart['cart']['pricing']['formattedOrderTotal'];
$delivery_info = 'Delivery in 2-5 working days and extended 30 days return period';
?>

<div class="dr-summary__subtotal">
    <input id="dr-total-float" type="hidden" value="<?php echo $cart['cart']['pricing']['orderTotal']['value'] ?>">
    <p class="subtotal-label"><?php echo __( 'Subtotal', 'digital-river-global-commerce' ) . ' - (' .  $subtotal_items . ' ' . $subtotal_items_text . ')' ?></p>

    <p class="subtotal-value"><?php echo $subtotal_value; ?></p>
</div>

<div class="dr-summary__tax">

    <p class="item-label"><?php echo drgc_should_display_vat( $customer['currency'] ) ? __( 'Estimated VAT', 'digital-river-global-commerce' ) : __( 'Estimated Tax', 'digital-river-global-commerce' ) ?></p>

    <p class="item-value"><?php echo $estimated_tax_value; ?></p>

</div>
<?php if( $cart['cart']['hasPhysicalProduct'] ) : ?>
<div class="dr-summary__shipping">

    <p class="item-label"><?php echo __( 'Estimated Shipping', 'digital-river-global-commerce' ) ?></p>

    <p class="item-value"><?php echo $shipping_price_value; ?></p>

</div>
<?php endif; ?>

<div class="dr-summary__discount" <?php if ( $discount === 0 ) echo 'style="display: none;"' ?>>

    <p class="discount-label"><?php echo __( 'Discount', 'digital-river-global-commerce' ) ?></p>

    <p class="discount-value"><?php echo '-' . $formatted_discount; ?></p>

</div>

<div class="dr-summary__total">

    <p class="total-label"><?php echo __( 'Total', 'digital-river-global-commerce' ) ?></p>

    <p class="total-value"><?php echo $total_value; ?></p>

</div>

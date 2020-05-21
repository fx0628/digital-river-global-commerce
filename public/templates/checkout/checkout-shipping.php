<?php
$shippingAddress = $cart['cart']['shippingAddress'];
if ( $customer_address ) {
    $shippingAddress = $customer_address[0];
} elseif ( $customer ) {
    $shippingAddress['firstName'] = $shippingAddress['firstName'] ?: $customer['firstName'];
    $shippingAddress['lastName'] = $shippingAddress['lastName'] ?: $customer['lastName'];
}
if ( $cart['cart']['shippingAddress']['line1'] != '') {
    $shippingAddress = $cart['cart']['shippingAddress'];
}
?>
<div class="dr-checkout__shipping dr-checkout__el">
    <div class="dr-accordion">

        <span class="dr-accordion__name">

            <span class="dr-accordion__title-long">

                <?php echo isset( $steps_titles['shipping'] ) ? $steps_titles['shipping'] : ''; ?>

            </span>

            <span class="dr-accordion__title-short">

                <?php echo __( 'Shipping', 'digital-river-global-commerce' ); ?>

            </span>

        </span>

        <span class="dr-accordion__edit"><?php echo __( 'Edit', 'digital-river-global-commerce' ); ?>></span>

    </div>
    <form id="checkout-shipping-form" class="dr-panel-edit dr-panel-edit--shipping needs-validation" novalidate>

         <div class="required-text">
            <?php echo __( 'Fields marked with * are mandatory', 'digital-river-global-commerce' ); ?>
         </div>

        <div class="form-group dr-panel-edit__el">

            <div class="float-container float-container--first-name">

                <label for="shipping-field-first-name" class="float-label ">

                    <?php echo __( 'First Name', 'digital-river-global-commerce' ); ?> *

                </label>

                <input id="shipping-field-first-name" type="text" value="<?php echo $shippingAddress['firstName'] ?>" name="shipping-firstName" class="form-control float-field float-field--first-name" required>

                <div class="invalid-feedback">

                    <?php echo __( 'This field is required.', 'digital-river-global-commerce' ); ?>

                </div>

            </div>

        </div>

        <div class="form-group dr-panel-edit__el">

            <div class="float-container float-container--last-name">

                <label for="shipping-field-last-name" class="float-label ">

                    <?php echo __( 'Last Name', 'digital-river-global-commerce' ); ?> *

                </label>

                <input id="shipping-field-last-name" type="text" value="<?php echo $shippingAddress['lastName'] ?>" name="shipping-lastName" class="form-control float-field float-field--last-name" required>

                <div class="invalid-feedback">

                    <?php echo __( 'This field is required.', 'digital-river-global-commerce' ); ?>

                </div>

            </div>

        </div>

        <div class="form-group dr-panel-edit__el">

            <div class="float-container float-container--address1">

                <label for="shipping-field-address1" class="float-label ">

                    <?php echo __( 'Address line 1', 'digital-river-global-commerce' ); ?> *

                </label>

                <input id="shipping-field-address1" type="text" value="<?php echo $shippingAddress['line1'] ?>" name="shipping-line1" class="form-control float-field float-field--address1" required>

                <div class="invalid-feedback">

                    <?php echo __( 'This field is required.', 'digital-river-global-commerce' ); ?>

                </div>

            </div>

        </div>

        <div class="form-group dr-panel-edit__el">

            <div class="float-container float-container--address2">

                <label for="shipping-field-address2" class="float-label">

                    <?php echo __( 'Address line 2/Company', 'digital-river-global-commerce' ); ?>

                </label>

                <input id="shipping-field-address2" type="text" name="shipping-line2" value="<?php echo $shippingAddress['line2'] ?>" class="form-control float-field float-field--address2">

            </div>

        </div>

        <div class="form-group dr-panel-edit__el">

            <div class="float-container float-container--city">

                <label for="shipping-field-city" class="float-label">

                    <?php echo __( 'City', 'digital-river-global-commerce' ); ?> *

                </label>

                <input id="shipping-field-city" type="text" name="shipping-city" value="<?php echo $shippingAddress['city'] ?>" class="form-control float-field float-field--city" required>

                <div class="invalid-feedback">

                    <?php echo __( 'This field is required.', 'digital-river-global-commerce' ); ?>

                </div>

            </div>

        </div>

        <div class="form-group dr-panel-edit__el">

            <select class="form-control custom-select" name="shipping-country" id="shipping-field-country" required>
                <option value="">
                    <?php echo __( 'Select Country', 'digital-river-global-commerce' ); ?> *
                </option>

                <?php foreach ( $locales['locales'] as $locale => $currency ): ?>
                    <?php
                        $country = drgc_code_to_counry($locale);
                        $abrvCountyName = drgc_code_to_counry($locale, true);

                        $output = "<option ";
                        $output .= ($shippingAddress['country'] === $abrvCountyName ? 'selected ' : '');
                        $output .= "value=\"{$abrvCountyName}\">{$country}</option>";
                        echo $output;
                    ?>
                <?php endforeach; ?>
            </select>

            <div class="invalid-feedback">

                <?php echo __( 'This field is required.', 'digital-river-global-commerce' ); ?>

            </div>

        </div>


        <div class="form-group dr-panel-edit__el d-none">

            <select class="form-control custom-select" name="shipping-countrySubdivision" id="shipping-field-state" required>

                <option value="">
                    <?php echo __( 'Select State', 'digital-river-global-commerce' ); ?> *
                </option>

                <?php foreach ($usa_states as $key => $state): ?>
                        <?php
                            $option = "<option ";
                            $option .= $shippingAddress['countrySubdivision'] === $key ? 'selected ' : '';
                            $option .= "value=\"{$key}\">{$state}</option>";
                            echo $option;
                        ?>
                <?php endforeach; ?>

            </select>

            <div class="invalid-feedback">

                <?php echo __( 'This field is required.', 'digital-river-global-commerce' ); ?>

            </div>

        </div>

        <div class="form-group dr-panel-edit__el">

            <div class="float-container float-container--zip">

                <label for="shipping-field-zip" class="float-label">

                    <?php echo __( 'Zipcode', 'digital-river-global-commerce' ); ?> *

                </label>

                <input id="shipping-field-zip" type="text" name="shipping-postalCode" value="<?php echo $shippingAddress['postalCode'] ?>" class="form-control float-field float-field--zip" required>

                <div class="invalid-feedback">

                    <?php echo __( 'This field is required.', 'digital-river-global-commerce' ); ?>

                </div>

            </div>

        </div>

        <div class="form-group dr-panel-edit__el">

            <div class="float-container float-container--phone">

                <label for="shipping-field-phone" class="float-label">

                    <?php echo __( 'Phone', 'digital-river-global-commerce' ); ?>

                </label>

                <input id="shipping-field-phone" type="text" name="shipping-phoneNumber" value="<?php echo $shippingAddress['phoneNumber'] ?>" class="form-control float-field float-field--phone">

            </div>

        </div>

        <div class="invalid-feedback dr-err-field" style="display: none"></div>

        <button type="submit" class="dr-panel-edit__btn dr-btn">

            <?php echo __( 'Save and continue', 'digital-river-global-commerce' ); ?>

        </button>

    </form>

    <div class="dr-panel-result">

        <p class="dr-panel-result__text"></p>

    </div>

</div>

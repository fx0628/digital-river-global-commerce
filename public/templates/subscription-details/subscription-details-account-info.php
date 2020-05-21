<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.digitalriver.com
 * @since      1.3.0
 *
 * @package    Digital_River_Global_Commerce
 * @subpackage Digital_River_Global_Commerce/public/templates/parts
 */

$payment_method = isset( $order['paymentMethod']['type'] ) ? $order['paymentMethod']['type'] : '';
$cc_expiration_year = '';
$cc_expiration_month ='';
$cc_last_digits = '';
$cc_brand = '';

if ( $payment_method === 'creditCard' ) {
    $cc_expiration_year = $order['paymentMethod']['creditCard']['expirationYear'];
    $cc_expiration_month = $order['paymentMethod']['creditCard']['expirationMonth'];
    $cc_last_digits = $order['paymentMethod']['creditCard']['lastFourDigits'];
    $cc_brand = $order['paymentMethod']['creditCard']['brand'];
}

$billing_first_name = isset( $order['billingAddress']['firstName'] ) ? $order['billingAddress']['firstName'] : '';
$billing_last_name = isset( $order['billingAddress']['lastName'] ) ? $order['billingAddress']['lastName'] : '';
$billing_address1 = isset($order['billingAddress']['line1']) ? $order['billingAddress']['line1'] : '';
$billing_city = isset($order['billingAddress']['city']) ? $order['billingAddress']['city'] : '';
$billing_code = isset($order['billingAddress']['postalCode']) ? $order['billingAddress']['postalCode'] : '';
$billing_country = isset($order['billingAddress']['countryName']) ? $order['billingAddress']['countryName'] : '';

if ( $billing_first_name !== '' && $billing_last_name !== '' ) {
    $billing_name = $billing_first_name . ' ' . $billing_last_name;
} else {
    $billing_name = $billing_first_name . $billing_last_name;
}

if ( $billing_city !== '' && $billing_code !== '' ) {
    $billing_address2 = $billing_city . ', ' . $billing_code;
} else {
    $billing_address2 = $billing_city . $billing_code;
}
?>

<fieldset id="account-info">
                
    <legend><?php echo __( 'Account Information', 'digital-river-global-commerce' ); ?></legend>
        
    <div>
    
        <p><?php echo __( 'The following is the information currently being used for payment.', 'digital-river-global-commerce' ); ?></p>
        
        <div><span><?php echo $cc_brand ?>: </span><span>**** **** **** <?php echo $cc_last_digits ?></span></div>
        
        <div><span><?php echo __( 'Expiration Date', 'digital-river-global-commerce' ); ?>: </span><span><?php echo $cc_expiration_month ?>/<?php echo $cc_expiration_year ?> </span></div>

    </div>

    <div id="account-info__billing">

        <u><?php echo __( 'Billing Address', 'digital-river-global-commerce' ); ?></u>

        <address>
            
            <?php echo $billing_name; ?><br />
            
            <?php echo $billing_address1; ?><br />
            
            <?php echo $billing_address2; ?><br />
            
            <?php echo $billing_country; ?>

        </address>

    </div>

</fieldset>

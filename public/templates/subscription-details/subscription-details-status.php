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

$auto_renewal = ( isset( $subs_details['autoRenewal'] ) && $subs_details['autoRenewal'] === 'enabled') ? 'On' : 'Off';
$expiration_date = isset( $subs_details['expirationDate'] ) ? esc_attr( explode( 'T', $subs_details['expirationDate'] )[0] ) : '';
$product_id = isset( $subs_details['products']['product']['uri'] ) ? explode( 'products/', $subs_details['products']['product']['uri'] )[1] : '';
$is_auto = false;
$custom_attributes = isset( $subs_details['products']['product']['customAttributes']['attribute'] ) ? $subs_details['products']['product']['customAttributes']['attribute'] : '';

if ( $custom_attributes ) {
    foreach ( $custom_attributes as $att ) { 
        if ( $att['name'] === 'isAutomatic' && $att['value'] === 'true' ) {
            $is_auto = true;
            break;
        }
    }
}

?>

<fieldset id="subscription-status">
                
    <legend><?php echo __( 'Subscription Status', 'digital-river-global-commerce' ); ?> - <?php echo $status ?></legend>

    <?php if ( $is_auto ) : ?>
            
        <?php if ( $auto_renewal === 'On') : ?>

            <p><?php echo __( 'Your subscription will automatically renew on', 'digital-river-global-commerce' ); ?> <span><?php echo $expiration_date ?></span>. <?php echo __( 'If you do not wish for it to automatically renew, update the setting below.', 'digital-river-global-commerce' ); ?></p>
        
        <?php endif; ?>

        <label for="auto-renewal-switch"><?php echo __( 'Automatic Renewals', 'digital-river-global-commerce' ); ?>: <?php echo __( 'Off', 'digital-river-global-commerce' ); ?></label>

        <label class="switch">
            
            <input type="checkbox" name="auto-renewal-switch" id="auto-renewal-switch" data-id="<?php echo $subs_id ?>" value="on" <?php if ( $auto_renewal === 'On' ) : ?> checked <?php endif; ?>>

            <span class="slider round"></span>
        
        </label>

        <label for="auto-renewal-switch"><?php echo __( 'On', 'digital-river-global-commerce' ); ?></label>

    <?php else: ?>

        <p><span><?php echo __( 'Automatic Renewals', 'digital-river-global-commerce' ); ?>: <?php echo __( 'Off', 'digital-river-global-commerce' ); ?></span></p>

    <?php endif; ?>

    <p><span><?php echo __( 'Expiration Date', 'digital-river-global-commerce' ); ?>: </span><span><?php echo $expiration_date ?></span></p>

    <button type="button" class="dr-btn" id="subs-renew-btn" data-id="<?php echo $subs_id ?>" data-product-id="<?php echo $product_id ?>" data-qty="<?php echo $next_renewnal_qty ?>"><?php echo __( 'Renew Now', 'digital-river-global-commerce' ); ?></button>

    <?php if ( $status !== 'Cancelled' ) : ?>

        <a href="javascript:void(0)" id="subs-cancel-link" data-id="<?php echo $subs_id ?>"><?php echo __( 'Cancel Subscription', 'digital-river-global-commerce' ); ?></a>

    <?php endif; ?>

</fieldset>

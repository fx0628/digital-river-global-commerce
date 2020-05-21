<?php
/**
 * Provide a publidr-facing view for the plugin
 *
 * This file is used to markup the publidr-facing aspects of the plugin.
 *
 * @link       https://www.digitalriver.com
 * @since      1.3.0
 *
 * @package    Digital_River_Global_Commerce
 * @subpackage Digital_River_Global_Commerce/public/partials
 */

$is_logged_in = $customer && 'Anonymous' !== $customer['id'];
$is_subs = false;
$line_items = isset( $order['order']['lineItems']['lineItem'] ) ? $order['order']['lineItems']['lineItem'] : '' ;

if ( $line_items ) {
    foreach ( $line_items as $item ) {
        foreach ( $item['product']['customAttributes']['attribute'] as $attribute ) {
            if ( $attribute['name'] === 'subscriptionType' ) {
                $is_subs = true;
                break 2;
            }
        }
    }
}
?>

<?php if ( $is_logged_in && $is_subs ) : ?>

    <button type="button" class="dr-btn" id="my-subs-btn"><?php echo __( 'My Subscriptions', 'digital-river-global-commerce' ); ?></button>

<?php endif; ?>

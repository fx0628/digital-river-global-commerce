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

$subs_id = isset( $subs_details['id'] ) ? $subs_details['id'] : '';
$product_name = isset( $subs_details['products']['product']['displayName'] ) ? $subs_details['products']['product']['displayName'] : '';
$current_qty = isset( $subs_details['renewalQuantity'] ) ? $subs_details['renewalQuantity'] : '';
$next_renewnal_qty = isset( $subs_details['nextRenewalQuantity'] ) ? $subs_details['nextRenewalQuantity'] : '';
$status = isset( $subs_details['status'] ) ? $subs_details['status'] : '';

$order_id = isset( $subs_details['orders']['order'] ) ? explode( 'orders/', $subs_details['orders']['order'][0]['uri'] )[1] : '';
$order = DRGC()->shopper->retrieve_order( $order_id );

$thumbnail = isset( $order['lineItems']['lineItem'][0]['product']['thumbnailImage'] ) ? $order['lineItems']['lineItem'][0]['product']['thumbnailImage'] : '';

?>

<p id="dr-back-to-my-subs">
    
    <a href="<?php echo esc_url( drgc_get_page_link( 'my-subscriptions' ) ); ?>">&lt; <?php echo __( 'Back to My Subscriptions Page', 'digital-river-global-commerce' ); ?></a>

</p>

<?php if ( $subs_id ) : ?>

    <div class="dr-subs-details-wrapper" id="dr-subs-details-page-wrapper">

        <div id="dr-subs-details-page-wrapper__id"><span><?php echo __( 'Subscription ID', 'digital-river-global-commerce' ); ?>: </span><span><?php echo $subs_id ?></span></div>

        <div id="dr-subs-details-page-wrapper__info">

            <div id="subscription-details-header">

                <h4><?php echo $product_name ?></h4>

                <span id="thumbnail">

                    <img alt="<?php echo $product_name ?>" src="<?php echo $thumbnail ?>" height="100" width="100">

                </span>

                <span><?php echo __( 'Current Quantity', 'digital-river-global-commerce' ); ?>: <?php echo $current_qty ?>&nbsp;&nbsp;</span>

                <span><?php echo __( 'Next Renewal Quantity', 'digital-river-global-commerce' ); ?>: <?php echo $next_renewnal_qty ?>&nbsp;&nbsp;</span>

                <?php if ( $status === 'Active' ) : ?>

                    <span><button type="button" class="dr-btn" id="subs-change-qty-btn" data-id="<?php echo $subs_id ?>"><?php echo __( 'Change Quantity', 'digital-river-global-commerce' ); ?></button></span>

                <?php endif; ?>

            </div>

            <?php include_once DRGC_PLUGIN_DIR . 'public/templates/subscription-details/subscription-details-status.php'; ?>

            <?php include_once DRGC_PLUGIN_DIR . 'public/templates/subscription-details/subscription-details-account-info.php'; ?>

            <?php include_once DRGC_PLUGIN_DIR . 'public/templates/subscription-details/subscription-details-order-history.php'; ?>

        </div>

    </div>

<?php endif; ?>
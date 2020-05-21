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

$orders = isset( $subs_details['orders']['order'] ) ? $subs_details['orders']['order'] : '';

?>

<fieldset id="order-history">
                
    <legend><?php echo __( 'Order History', 'digital-river-global-commerce' ); ?></legend>
    
    <div>

        <p><?php echo __( 'View the order history for your subscription.', 'digital-river-global-commerce' ); ?></p>
    
    </div>
    
    <?php if ( $orders ) : ?>
                        
        <button class="collapsible" id="view-order-history-link"><?php echo __( 'View Order History', 'digital-river-global-commerce' ); ?></button>

        <div class="content" id="order-history__orders">
    
            <table class="data-table" style="margin-top: 18px; margin-bottom: 18px;">
                
                <thead>
                    
                    <tr>
                        <th><?php echo __( 'Order Number', 'digital-river-global-commerce' ); ?></th>

                        <th><?php echo __( 'Order Date', 'digital-river-global-commerce' ); ?></th>

                        <th><?php echo __( 'Order Amount', 'digital-river-global-commerce' ); ?></th>

                    </tr>

                </thead>
                
                <tbody>
                
                <?php 
                    foreach ( $orders as $order ) {
                        $order_id = explode( 'orders/', $order['uri'] )[1];
                        $order_details = DRGC()->shopper->retrieve_order( $order_id );
                        $order_date = esc_attr( explode( 'T', $order_details['submissionDate'] )[0] );
                        $order_amount = $order_details['pricing']['formattedTotal'];
                ?>
                        <tr>
                            
                            <td><?php echo $order_id ?></td>

                            <td><?php echo $order_date ?></td>

                            <td><?php echo $order_amount ?></td>
                        
                        </tr>

                <?php
                    }
                ?>

                </tbody>
            
            </table>

        </div>

    <?php endif; ?>

</fieldset>

<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.digitalriver.com
 * @since      1.0.0
 *
 * @package    Digital_River_Global_Commerce
 * @subpackage Digital_River_Global_Commerce/public/templates/parts
 */


?>

<?php if ( $subs ) : ?>

    <div class="dr-my-subs-wrapper" id="dr-my-subs-page-wrapper">

        <div class="dr-my-subs-wrapper__info">

            <form id="subscription-details-form" action="<?php echo esc_url( drgc_get_page_link( 'subscription-details' ) ); ?>" method="post">
                
                <input type="hidden" name="subscription_id">
                
                <table class="data-table">
                    
                    <thead>
                        
                        <tr>
                            <th><?php echo __( 'Product Name', 'digital-river-global-commerce' ); ?></th>

                            <th><?php echo __( 'Status', 'digital-river-global-commerce' ); ?></th>

                            <th><?php echo __( 'Auto Renewal Date', 'digital-river-global-commerce' ); ?></th>

                            <th><?php echo __( 'Price', 'digital-river-global-commerce' ); ?></th>

                            <th><?php echo __( 'Expiration Date', 'digital-river-global-commerce' ); ?></th>

                        </tr>

                    </thead>
                    
                    <tbody>
                    
                    <?php 
                        foreach ( $subs as $sub ) {
                            $subs_id = $sub['id'];
                            $product_id = $sub['products']['product']['id'];
                            $order_id = explode( 'orders/', $sub['orders']['order'][0]['uri'] )[1];
                            $order = DRGC()->shopper->retrieve_order( $order_id );
                            $price = $order['pricing']['formattedTotal'];
                            $next_renewal_date = esc_attr( explode( 'T', $sub['nextRenewalDate'] )[0] );

                            if ($sub['status'] === 'Cancelled') {
                                $next_renewal_date = __( 'Renew Now!', 'digital-river-global-commerce' );
                            } else {
                                if ( $sub['autoRenewal'] === 'disabled') {
                                    $next_renewal_date = __( 'Not Applicable', 'digital-river-global-commerce' );
                                }
                            }
                    ?>
                            <tr>
                                <?php if ( $sub['status'] === 'Cancelled' ) : ?>
                                    
                                    <td><?php echo esc_attr( $sub['products']['product']['displayName'] ) ?></td>

                                <?php else: ?>
                                
                                    <td><a href="javascript:void(0)" class="subs-name" data-id="<?php echo $subs_id ?>"><?php echo esc_attr( $sub['products']['product']['displayName'] ) ?></a></td>

                                <?php endif; ?>

                                <td><?php echo $sub['status'] ?></td>

                                <?php if ( $sub['status'] === 'Cancelled' ) : ?>
                                
                                    <td><a href="javascript:void(0)" class="renew-cancalled" data-id="<?php echo $subs_id ?>" data-product-id="<?php echo $product_id ?>"><?php echo $next_renewal_date ?></a></td>

                                <?php else: ?>
                                
                                    <td><?php echo $next_renewal_date ?></td>

                                <?php endif; ?>

                                <td><?php echo $price ?></td>
                                
                                <td><?php echo esc_attr( explode( 'T', $sub['expirationDate'] )[0] ) ?></td>
                            
                            </tr>

                    <?php
                        }
                    ?>

                    </tbody>
                
                </table>
            
            </form>
        
        </div>

    </div>

<?php endif; ?>

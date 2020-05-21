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
?>

<section class="dr-cart__auto-renewal-terms">

    <div id="dr-autoRenewTermsContainer" style="display: none;">
        
        <fieldset id="dr-autoRenew">
            
            <legend>
                
                <?php echo __( 'Auto-Renewal Plan Terms', 'digital-river-global-commerce' ); ?>
            
            </legend>
            
            <h3>

                <?php echo __( 'Auto-Renewal Plan Terms', 'digital-river-global-commerce' ); ?>
            
            </h3>
        
            <div id="dr-optInAutoRenew">
                
                <div class="dr-optInAutoRenewTerms">

                    <p></p>
                    
                </div>
        
                <div class="dr-optInAutoRenewAction">
        
                    <input type="checkbox" name="autoRenewOptedInOnCheckout" id="autoRenewOptedInOnCheckout">
        
                    <label for="autoRenewOptedInOnCheckout">
                        
                        <?php echo __( 'I have read and agree to the terms and charges above.', 'digital-river-global-commerce' ); ?>
                    
                    </label>
        
                </div>

                <div class="invalid-feedback" id="dr-TAndC-err-msg"></div>
        
            </div>
        
        </fieldset>
        
    </div>

</section>

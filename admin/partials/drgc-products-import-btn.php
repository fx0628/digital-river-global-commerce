<?php
/**
 * Render product import button.
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.digitalriver.com
 * @since      1.0.0
 *
 * @package    Digital_River_Global_Commerce
 * @subpackage Digital_River_Global_Commerce/admin/partials
 */
?>

<?php if ( isset( $_GET['import-complete'] ) ) : ?>
    <div class="notice notice-success is-dismissible"><p><?php _e( 'Import Complete!', 'digital-river-global-commerce' ); ?></p></div>
<?php endif; ?>

<div class="wrapImport">
    <noscript><p><em><?php _e( 'You must enable Javascript in order to proceed!', 'digital-river-global-commerce' ) ?></em></p></noscript>
    <div id="dr-data-process-progressbar"></div>
</div>
<div class="wrapImportControls">
    <p>
        Processing <span id="dr-data-process-counter">0</span> out of <span id="dr-data-process-total">many</span>
    </p>

    <button type="button" id="products-import-btn" class="button"><?php echo __( 'Import Products', 'digital-river-global-commerce' ); ?></button>
</div>

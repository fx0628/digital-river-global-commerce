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

<?php
$purchasable = get_post_meta( get_the_ID(), 'purchasable', true );
$variations = drgc_get_product_variations( get_the_ID() );

if ( $variations && isset( $variations[0] ) ) {
    //sort variation array by sale price here!
    $variations_sort = array();
  
    foreach ( $variations as $variation ) {
        $var_pricing = drgc_get_product_pricing( $variation->ID );
        $variation->sort_pricing = $var_pricing['sale_price_value'];
        array_push( $variations_sort, $variation );
    }

    usort( $variations_sort, function( $a, $b ) {
        if ( $a == $b ) {
            return 0;
        }

        return ( $a->sort_pricing < $b->sort_pricing ) ? -1 : 1;
    });

    $variations = $variations_sort;
    $gc_id = get_post_meta( $variations[0]->ID, 'gc_product_id', true );
    $pricing = drgc_get_product_pricing( $variations[0]->ID );
    $product_image_url = get_post_meta( $variations[0]->ID, 'gc_product_images_url', true );
    $product_thumbnail_url = get_post_meta( $variations[0]->ID, 'gc_thumbnail_url', true );
} else {
    $gc_id = get_post_meta( get_the_ID(), 'gc_product_id', true );
    $pricing = drgc_get_product_pricing( get_the_ID() );
    $product_image_url = get_post_meta( get_the_ID(), 'gc_product_images_url', true );
    $product_thumbnail_url = get_post_meta( get_the_ID(), 'gc_thumbnail_url', true );
}

$list_price = isset( $pricing['list_price_value'] ) ? $pricing['list_price_value'] : '';
$sale_price = isset( $pricing['sale_price_value'] ) ? $pricing['sale_price_value'] : '';
$price = isset( $pricing['price'] ) ? $pricing['price'] : '';
?>

<div class="dr-pd-item">
    <a href="<?php echo get_permalink(); ?>">
        <div class="dr-pd-item-thumbnail">
            <img src="<?php echo $product_thumbnail_url ?: $product_image_url ?>" alt="<?php the_title_attribute() ?>"/>
        </div>

        <?php the_title( '<h3 class="dr-pd-item-title">', '</h3>' ); ?>

        <?php if ( (int) $list_price > (int) $sale_price ) : ?>
            <p class="dr-pd-price dr-pd-item-price">
                <del class="dr-strike-price"><?php echo $list_price; ?></del>
                <strong class="dr-sale-price"><?php echo $price; ?></strong>
            </p>
        <?php else: ?>
            <p class="dr-pd-price dr-pd-item-price">
                <strong class="dr-sale-price"><?php echo $price; ?></strong>
            </p>
        <?php endif; ?>

        <button type="button" class="dr-btn dr-buy-btn" data-product-id="<?php echo $gc_id; ?>" <?php echo 'true' !== $purchasable ? 'disabled' : ''; ?>>
            <?php echo __( 'Add to Cart', 'digital-river-global-commerce'); ?>
        </button>

        <?php the_content(); ?>
    </a>
</div>

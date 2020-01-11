<?php
	/**
		* The template for displaying product content within loops
		*
		* This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
		*
		* HOWEVER, on occasion WooCommerce will need to update template files and you
		* (the theme developer) will need to copy the new files to your theme to
		* maintain compatibility. We try to do this as little as possible, but it does
		* happen. When this occurs the version of the template file will be bumped and
		* the readme will list any important changes.
		*
		* @see     https://docs.woocommerce.com/document/template-structure/
		* @package WooCommerce/Templates
		* @version 3.6.0
	*/
	
	defined( 'ABSPATH' ) || exit;
	
	global $product;
	
	// Ensure visibility.
	if ( empty( $product ) || ! $product->is_visible() ) {
		return;
	}
?>
<div class="col-xl-3 col-lg-4 col-md-6 <?php wc_product_class( '', $product ); ?>">
	<div class="catalog-productbox">
		<a href="<? the_permalink(); ?>">
			<div class="catalog-productbox__pic">
				<img src="<? echo get_the_post_thumbnail_url( $id, 'large' ); ?>" alt="product image">
			</div>
		</a>
		<div class="catalog-productbox__text">
			<a href="<? the_permalink(); ?>" class="title"><? the_title(); ?></a>
			<p class="price"><?php echo $product->get_price_html(); ?></p>
			<a href="<? the_permalink(); ?>">
				<div class="basket-cat">
				</div>
			</a>
		</div>
		
	</div>
</div>

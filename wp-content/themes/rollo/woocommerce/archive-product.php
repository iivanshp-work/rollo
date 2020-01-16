<?php
	/**
		* The Template for displaying product archives, including the main shop page which is a post type archive
		*
		* This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
		*
		* HOWEVER, on occasion WooCommerce will need to update template files and you
		* (the theme developer) will need to copy the new files to your theme to
		* maintain compatibility. We try to do this as little as possible, but it does
		* happen. When this occurs the version of the template file will be bumped and
		* the readme will list any important changes.
		*
		* @see https://docs.woocommerce.com/document/template-structure/
		* @package WooCommerce/Templates
		* @version 3.4.0
	*/
	
	defined( 'ABSPATH' ) || exit;
	
	//get_header( 'shop' );
	get_header();
?>

<main>
	<div class="breadcrums">
        <div class="container">
			<? 	get_template_part( 'template-parts/bread'); ?>
		</div>
	</div>
	
	<div class="filter-category">
		<div class="container">
			<div>
				<div class="filtercat">
					<select name="" id="" onchange="window.location.href=this.options[this.selectedIndex].value">
						<option>Сортування</option>
						<?php dynamic_sidebar( 'prod-sort' ); ?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<section class="category-section">
		<div class="container">
			<div class="row">
				<div class="col-filter">
					<div class="filter">
						<div class="filter__box">
							<p class="filter__title">Тип</p>
							<div class="filter__lists radiostyled">
								<?php dynamic_sidebar( 'prod-filtr-1' ); ?>	
							</div>
							
						</div>
						<div class="filter__box">
							<p class="filter__title">Колір</p>
							<div class="filter__lists filter__colors">
								<?php dynamic_sidebar( 'prod-filtr-color' ); ?>
							</div>
						</div>
						<div class="filter__box">
							<p class="filter__title">Затемнення</p>
							<div class="filter__lists radiostyled">
								<?php dynamic_sidebar( 'prod-filtr-temno' ); ?>
							</div>
						</div>
						<div class="filter__box">
							<p class="filter__title">Фактура</p>
							<div class="filter__lists radiostyled">
								<?php dynamic_sidebar( 'prod-filtr-faktura' ); ?>
							</div>
						</div>
						<div class="filter__box">
							<p class="filter__title">Малюнок</p>
							<div class="filter__lists radiostyled">
								<?php dynamic_sidebar( 'prod-filtr-mal' ); ?>
								
							</div>
						</div>
						<div class="filter__box">
							<p class="filter__title">Виробник</p>
							<div class="filter__lists radiostyled">
								<?php dynamic_sidebar( 'prod-filtr-vyr' ); ?>
								
							</div>
						</div>
					</div>
					
					
					
				</div>
				<div class="col">
					<div class="row products">
						
						<?
							/**
								* Hook: woocommerce_before_main_content.
								*
								* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
								* @hooked woocommerce_breadcrumb - 20
								* @hooked WC_Structured_Data::generate_website_data() - 30
							*/
							// do_action( 'woocommerce_before_main_content' );
						?>
						
						<?php
							
							
							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();
									
									/**
										* Hook: woocommerce_shop_loop.
									*/
									do_action( 'woocommerce_shop_loop' );
									wc_get_template_part( 'content', 'product' );
									
								}
							}
							
							
						?>
						
					</div>
					<? $args = array(
						'show_all'           => true,
						'end_size'           => 1,
						'mid_size'           => 2,
						'prev_next'          => false,
						'add_args'           => false,
						'type'         => 'list',
						'add_fragment'       => '',
						'screen_reader_text' => __( 'Posts navigation' ),
					);            ?>
					
					<div class="pagination shop-pag">
						<ul class=" nostyle-list">
							<? echo paginate_links( $args ); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?
	
	//get_footer( 'shop' );
	get_footer();
	

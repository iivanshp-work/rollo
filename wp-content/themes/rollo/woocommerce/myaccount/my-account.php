<?php
	/**
		* My Account page
		*
		* This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
		*
		* HOWEVER, on occasion WooCommerce will need to update template files and you
		* (the theme developer) will need to copy the new files to your theme to
		* maintain compatibility. We try to do this as little as possible, but it does
		* happen. When this occurs the version of the template file will be bumped and
		* the readme will list any important changes.
		*
		* @see     https://docs.woocommerce.com/document/template-structure/
		* @package WooCommerce/Templates
		* @version 3.5.0
	*/
	
	defined( 'ABSPATH' ) || exit;
?>
<main>
   
    <div class="user-content">
        <div class="row no-gutters">
            <aside class="user-panel woocommerce-MyAccount-navigation">
                <?
					/**
						* My Account navigation.
						*
						* @since 2.6.0
					*/
					do_action( 'woocommerce_before_account_navigation' );
				?>
                <ul class="nostyle-list">
                    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                    <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                        <a
                            href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                    </li>

                    <?  if ( $endpoint == 'orders') {?>
                    <li class="<?php echo wc_get_account_menu_item_classes( 'my-cart' ); ?>">
                        <?php global $woocommerce; ?>
                        <a href="<?php echo $woocommerce->cart->get_cart_url() ?>"><?php echo 'Корзина' ?>
                            (<?php echo sprintf($woocommerce->cart->cart_contents_count); ?>)</a>
                    </li>
                    <?}?>

                    <?php endforeach; ?>
                </ul>
                <?php do_action( 'woocommerce_after_account_navigation' ); ?>
            </aside>
            <div class="col rightsect">
                <div class="user-info">

                    <div class="woocommerce-MyAccount-content">
                        <?php
							/**
								* My Account content.
								*
								* @since 2.6.0
							*/
							do_action( 'woocommerce_account_content' );
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
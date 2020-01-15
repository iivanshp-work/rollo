<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table">
    <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            $attributes = isset($cart_item['attributes']) ? $cart_item['attributes'] : [];
            $descAttributes = ['pa_storona-upravlinnya' => __('cторона управління'), 'pa_kolory-systemy' => __('колір системи')];
            $descData = [];
            if (!empty($attributes)) {
                foreach($descAttributes as $descAttribute => $descAttributeLabel) {
                    if (isset($attributes[$descAttribute]) && $attributes[$descAttribute]) {
                        $term_obj = get_term_by('slug', $attributes[$descAttribute], $descAttribute);
                        if ($term_obj) {
                            $descData[] = __($term_obj->name) . ' ' . $descAttributeLabel;
                        }
                    }
                }
            }
            $descData = !empty($descData) ? implode(', ', $descData) : '';
            $width = isset($attributes['width']) ? $attributes['width'] : 0;
            $height = isset($attributes['height']) ? $attributes['height'] : 0;

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ):

    ?>
                <div class="incard__row">
                    <div class="incard__pic">
                        <a href="<?php echo $_product->get_slug(); ?>"><?php echo $_product->get_image(); ?></a>
                    </div>
                    <div class="incard__text">
                        <a href="<?php echo $_product->get_slug(); ?>"> <p class="title"><?php echo $_product->get_name(); ?></p></a>
                        <?php if($width && $height): ?><p class="size"><?php echo $width; ?> х <?php echo $height; ?> мм</p> <?php endif; ?>
                        <?php if($descData): ?><p class="descr"><?php echo $descData; ?></p><?php endif; ?>
                    </div>
                    <div class="incard__num">
                        <div class="input-group">
                          <?php if($cart_item['quantity'] > 1): ?>
                            <input type="button" value="" class="button-minus" data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']-1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>">
                          <?php endif;?>
                            <input type="text" step="1" max="" value="<?php echo $cart_item['quantity']; ?>" name="quantity"
                                   class="quantity-field">
                            <input type="button" value="" class="button-plus" data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']+1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>">
                        </div>
                    </div>
                    <div class="incard__price"><?php echo wc_price($_product->get_price()); ?></div>
                    <div class="incard__remove" data-remove-cart-item="" data-cart-item-key="<?php echo $cart_item_key; ?>"><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/remove-icon.svg" alt="remove"></div>
                </div>
    <?php
            endif;
        endforeach;
    ?>
    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
        <div class="incard__bottsect cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
            <span class="lefttext"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
            <span class="lefttext"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
        </div>
    <?php endforeach; ?>

    <div class="incard__bottsect">
        <span class="lefttext"><?php echo __('До оплати');?></span>
        <span class="allprice"><?php wc_cart_totals_order_total_html(); ?></span>
    </div>
</div>
<!--
<table class="shop_table woocommerce-checkout-review-order-table">
	<thead>
		<tr>
			<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<td class="product-name">
						<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</td>
					<td class="product-total">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
	<tfoot>

		<tr class="cart-subtotal">
			<th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total">
			<th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
</table>
-->

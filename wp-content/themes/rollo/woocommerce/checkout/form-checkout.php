<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_review_order_after_order_total', 'woocommerce_checkout_payment', 20 );

//do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}

?>

<main>
  <div class="breadcrums">
    <div class="container">
        <? 	get_template_part( 'template-parts/bread'); ?>
    </div>
  </div>

  <section class="ordering">
    <div class="container">
      <h3><?php the_title(); ?></h3>

      <div class="row">
        <div class="col-xl-5 col-md-5">
          <form name="checkout" method="post" class="checkout woocommerce-checkout form-section" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
              <?php if ( $checkout->get_checkout_fields() ) : ?>
                <div class="orderingform_box">
                  <p class="title"><span>1</span> <?php echo pll__('Особисті дані'); ?></p>
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                </div>
                <div class="orderingform_box">
                  <p class="title"><span>2</span> <?php echo pll__('Доставка'); ?></p>

                    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                      <div class="inpinline-field align-items-start">
                        <label><?php echo pll__('Спосіб доставки'); ?></label>
                        <div class="delivery-field">
                            <?php
                            $packages           = WC()->shipping()->get_packages();
                            $first              = true;

                            foreach ( $packages as $i => $package ) {
                                $chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
                                $product_names = array();

                                if ( count( $packages ) > 1 ) {
                                    foreach ( $package['contents'] as $item_id => $values ) {
                                        $product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
                                    }
                                    $product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
                                }
                                $available_methods = $package['rates'];
                                $show_package_details = count( $packages ) > 1;
                                $show_shipping_calculator = is_cart() && apply_filters( 'woocommerce_shipping_show_shipping_calculator', $first, $i, $package );
                                $package_details =  implode( ', ', $product_names );
                                $package_name =  apply_filters( 'woocommerce_shipping_package_name', ( ( $i + 1 ) > 1 ) ? sprintf( _x( 'Shipping %d', 'shipping packages', 'woocommerce' ), ( $i + 1 ) ) : _x( 'Shipping', 'shipping packages', 'woocommerce' ), $i, $package );
                                $index =  $i;
                                $formatted_destination =  WC()->countries->get_formatted_address( $package['destination'], ', ' );
                                $has_calculated_shipping =  WC()->customer->has_calculated_shipping();
                                if (!empty($available_methods)) {
                                    $available_methods_sort = [
                                        "nova_poshta_shipping:1",
                                        "u_poshta_shipping_method",
                                        "local_pickup:2",
                                    ];
                                    $available_methods_tmp = [];
                                    foreach ($available_methods_sort as $sort_item) {
                                        foreach($available_methods as $key_item => $item) {
                                            if ($sort_item == $key_item) {
                                                $available_methods_tmp[$key_item] = $item;
                                                break;
                                            }
                                        }
                                    }
                                    $available_methods = $available_methods_tmp;
                                }
                                ?>
                              <ul class="shipping-available_methods">
                                  <?php foreach ( $available_methods as $method ) : ?>
                                    <li>
                                        <?php
                                        printf( '<label class="check-formfield2" for="shipping_method_%1$s_%2$s">', $index, pll__(esc_attr( sanitize_title( $method->id ) )), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
                                        printf( '<span class="custom-checkbox"><input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="blueact shipping_method" %4$s /><span class="checkmark"></span></span>', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
                                        printf( '%1$s</label>',  wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
                                        do_action( 'woocommerce_after_shipping_rate', $method, $index );
                                        if ($method->method_id == 'nova_poshta_shipping') {
                                            do_action( 'woocommerce_before_order_notes', $checkout );
                                        }
                                        if ($method->id == 'u_poshta_shipping_method') {
                                            do_action( 'woocommerce_u_poshta_shipping_method', $checkout );
                                        }
                                        ?>
                                    </li>
                                  <?php endforeach; ?>
                              </ul>
                                <?php

                                $first = false;
                            }
                            ?>
                        </div>
                      </div>
                    <?php endif; ?>

                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                </div>
              <?php endif;?>

            <div class="orderingform_box">
              <div class="inpinline-field align-items-start">
                <label>Оплата</label>
                <div class="delivery-field">
                    <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
                </div>
              </div>
            </div>
            <noscript>
                <?php
                printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
                ?>
              <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
            </noscript>

              <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="black-btn" name="woocommerce_checkout_place_order" id="place_order" value="' .  pll__('Оформити замовлення') . '" data-value="' .  pll__('Оформити замовлення') . '">' .  pll__('Оформити замовлення') . '</button>' ); // @codingStandardsIgnoreLine ?>

              <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

              <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>

          </form>
        </div>

        <div class="col-xl-6 offset-xl-1 col-md-7">
          <div class="incard">
            <p class="incard__title"><?php echo pll__('У вашій корзині'); ?></p>
              <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
              <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<!--
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

</form>-->


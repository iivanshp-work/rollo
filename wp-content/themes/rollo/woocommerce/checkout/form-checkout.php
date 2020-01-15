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
                        <div class="orderingform_box">
                            <p class="title"><span>1</span> Особисті дані</p>
                            <div class="inpinline-field">
                                <label for="name">Ім’я та прізвище</label>
                                <input type="text" id="name" class="name-input">
                            </div>
                            <div class="inpinline-field">
                                <label for="city">Місто</label>
                                <input type="text" id="city" class="city-input">
                            </div>
                            <div class="inpinline-field">
                                <label for="phone">Телефон</label>
                                <input type="text" id="phone" class="phone-input">
                            </div>
                            <div class="inpinline-field">
                                <label for="email">Email</label>
                                <input type="text" id="email" class="email-input">
                            </div>
                        </div>
                        <div class="orderingform_box">
                            <p class="title"><span>2</span> Доставка</p>
                            <div class="inpinline-field align-items-start">
                                <label>Спосіб доставки</label>
                                <div class="delivery-field">
                                    <div class="check-formfield">
                                        <input type="radio" id="delivery1" class="blueact" name="delivery">
                                        <label for="delivery1">самовивіз з Нової Пошти</label>
                                    </div>
                                    <div class="select-formfield">
                                        <select name="" id="">
                                            <option value="0">Виберіть відділення</option>
                                            <option value="1">Відділення 1</option>
                                            <option value="2">Відділення 2</option>
                                            <option value="3">Відділення 3</option>
                                            <option value="4">Відділення 4</option>
                                        </select>
                                    </div>
                                    <div class="check-formfield">
                                        <input type="radio" id="delivery2" class="blueact" name="delivery">
                                        <label for="delivery2">кур'єр Нова Пошта</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="orderingform_box">
                            <div class="inpinline-field align-items-start">
                                <label>Оплата</label>
                                <div class="delivery-field">
                                    <div class="check-formfield">
                                        <input type="radio" id="payment1" class="blueact" name="payment">
                                        <label for="payment1">Оплата при отриманні замовлення
                                        </label>
                                    </div>
                                    <div class="check-formfield">
                                        <input type="radio" id="payment2" class="blueact" name="payment">
                                        <label for="payment2">Оплатити зараз карткою Visa/Mastercard
                                        </label>
                                        <div class="payment-pic">
                                            <img src="image/icon/mastercard.svg" alt="MasterCard">
                                            <img src="image/icon/visa.svg" alt="Visa">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Оформити замовлення" class="black-btn">

                        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

                    </form>
                </div>

                <div class="col-xl-6 offset-xl-1 col-md-7">
                    <div class="incard">
                        <p class="incard__title">У вашій корзині</p>
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

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>


</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

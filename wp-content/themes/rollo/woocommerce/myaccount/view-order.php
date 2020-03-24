<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();
?>
<p class="order_info_line">
    <?php
    printf(
    /* translators: 1: order number 2: order date 3: order status */
        esc_html__( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'woocommerce' ),
        '<mark class="order-number">' . $order->get_order_number() . '</mark>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        '<mark class="order-date">' . wc_format_datetime( $order->get_date_created() ) . '</mark>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        '<mark class="order-status">' . wc_get_order_status_name( $order->get_status() ) . '</mark>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    );
    ?>
</p>

<?php if ( $notes ) : ?>
    <h2><?php esc_html_e( 'Order updates', 'woocommerce' ); ?></h2>
    <ol class="woocommerce-OrderUpdates commentlist notes">
        <?php foreach ( $notes as $note ) : ?>
            <li class="woocommerce-OrderUpdate comment note">
                <div class="woocommerce-OrderUpdate-inner comment_container">
                    <div class="woocommerce-OrderUpdate-text comment-text">
                        <p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( esc_html__( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                        <div class="woocommerce-OrderUpdate-description description">
                            <?php echo wpautop( wptexturize( $note->comment_content ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>

<?php /*do_action( 'woocommerce_view_order', $order_id );*/ ?>

<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

if ( ! $order ) {
    return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
    wc_get_template(
        'order/order-downloads.php',
        array(
            'downloads'  => $downloads,
            'show_title' => true,
        )
    );
}
?>
<section class="woocommerce-order-details">
    <?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

    <h2 class="woocommerce-order-details__title"><?php echo pll__( 'Інформація по замовленню:'); ?></h2>

    <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

        <!--<thead>
            <tr>
                <th class="woocommerce-table__product-name product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                <th class="woocommerce-table__product-table product-total"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
            </tr>
            </thead>-->

        <tbody>
        <?php
        do_action( 'woocommerce_order_details_before_order_table_items', $order );

        foreach ( $order_items as $item_id => $item ) {
            $product = $item->get_product();


            ?>

            <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">

                <td class="woocommerce-table__product-name product-name">
                    <?php
                    $is_visible        = $product && $product->is_visible();
                    $product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

                    echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                    $qty          = $item->get_quantity();
                    $refunded_qty = $order->get_qty_refunded_for_item( $item_id );

                    if ( $refunded_qty ) {
                        $qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
                    } else {
                        $qty_display = esc_html( $qty );
                    }


                    do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );
                    $attribute['width'] = $item->get_meta("_product_attribute_width");
                    $attribute['height'] = $item->get_meta("_product_attribute_height");
                    $attribute['kolory-systemy'] = $item->get_meta("_product_attribute_pa_kolory-systemy");
                    if ($attribute['kolory-systemy']) {
                        $term_obj = get_term_by('slug', $attribute['kolory-systemy'], "pa_kolory-systemy");
                        $attribute['kolory-systemy'] = $term_obj ? pll__($term_obj->name) : ucfirst($attribute['kolory-systemy']);
                    }
                    if ($attribute['width'] && $attribute['height']) {
                        echo '<span class="width_height">&nbsp;&nbsp;' . $attribute['width'] . 'x' . $attribute['height'] . '</span>';
                    }

                    echo apply_filters( 'woocommerce_order_item_quantity_html', ' -<span class="product-quantity">' . sprintf( '&nbsp;%s', $qty_display ) . 'шт</span>', $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                    if ($attribute['kolory-systemy']) {
                        echo ", " . pll__("фурнітура") . " - " . $attribute['kolory-systemy'];
                    }

                    //wc_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                    do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
                    ?>
                </td>

                <!--<td class="woocommerce-table__product-total product-total">
                        <?php echo $order->get_formatted_line_subtotal( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </td>-->

            </tr>

            <?php
        }

        do_action( 'woocommerce_order_details_after_order_table_items', $order );
        ?>
        </tbody>

        <tfoot>
        </tfoot>
    </table>


    <?php
    $totals = $order->get_order_item_totals();
    $orderTotal = isset($totals['order_total']) ? $totals['order_total'] : null;
    ?>
    <?php if ($orderTotal):?>
        <div class="my_order_total">
            <h2>
                <?php echo pll__( 'Сума замовлення:'); ?>
                <span><?php echo $orderTotal['value'] ; ?></span>
            </h2>
        </div>
    <?php endif; ?>

</section>

<?php
if ( $show_customer_details ):


    /**
     * Order Customer Details
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce/Templates
     * @version 3.4.4
     */

    $shippingMethodId = reset( $order->get_items( 'shipping' ))->get_method_id();
    ?>
    <section class="woocommerce-customer-details">

        <div class="my_order_address">
            <h2 class="woocommerce-column__title">
                <?php echo pll__( 'Адреса:' ); ?>
                <span>
                <?php if ($shippingMethodId == 'u_poshta_shipping_method'): ?>
                    <?php if ( $order->get_billing_city() ) : ?>
                        <p class="woocommerce-customer-details--city"><?php echo esc_html( $order->get_billing_city() ); ?></p>
                    <?php endif; ?>
                    <?php if ( $order->get_billing_state() ) : ?>
                        <p class="woocommerce-customer-details--state">(<?php echo esc_html( $order->get_billing_state() ); ?> обл.)</p>
                    <?php endif; ?>
                    <?php if ( $order->get_billing_postcode() ) : ?>
                        <p class="woocommerce-customer-details--city">, <?php echo esc_html( $order->get_billing_postcode() ); ?></p>
                    <?php endif; ?>
                <?php elseif ($shippingMethodId == 'nova_poshta_shipping'): ?>
                    <?php if ( $order->get_billing_address_1() ) : ?>
                        <p class="woocommerce-customer-details--address_1"><?php echo esc_html( $order->get_billing_address_1() ); ?></p>
                    <?php endif; ?>
                    <?php if ( $order->get_billing_city() ) : ?>
                        <p class="woocommerce-customer-details--city"><?php echo esc_html( $order->get_billing_city() ); ?></p>
                    <?php endif; ?>
                    <?php if ( $order->get_billing_state() ) : ?>
                        <p class="woocommerce-customer-details--state">(<?php echo esc_html( $order->get_billing_state() ); ?> обл.)</p>
                    <?php endif; ?>
                <?php else: ?>
                    -
                <?php endif; ?>
            </span>
            </h2>
        </div>

        <div class="my_order_user_info">
            <h2 class="woocommerce-column__title">
                <?php echo pll__( 'Отримувач:' ); ?>
                <?php if ( $order->get_billing_first_name() ) : ?>
                    <p class="woocommerce-customer-details--name"><?php echo esc_html( $order->get_billing_first_name() ); ?></p>
                <?php endif; ?>

                <?php if ( $order->get_billing_phone() ) : ?>
                    <p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
                <?php endif; ?>
            </h2>
        </div>

        <?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

    </section>

<?php endif;?>

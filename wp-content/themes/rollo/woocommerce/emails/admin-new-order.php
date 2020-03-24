<?php
/**
 * Admin new order email (plain text)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/admin-new-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails/Plain
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
echo "<div style='width: auto;max-width: 1800px;display: block;margin: 0 auto;'>";
echo '<h2 style="padding-bottom: 5px;border-bottom: 2px solid #000;margin-bottom: 20px;">Замовлення № ' . $order->get_id() . '</h2>';

if ($order->get_billing_email()) {
    echo "<span style='width: 100%;display: inline-block;'>";
    echo "<span style='width: 33%;display: inline-block;'>";
    echo "<strong style='font-size: 18px;'><i>" . $order->get_formatted_billing_full_name() . "</i></strong>";
    echo "</span>";
    echo "<span style='width: 33%;display: inline-block;text-align: center;'>";
    echo "тел. " . "<strong style='font-size: 16px;'>" . $order->get_billing_phone() . "</strong>";
    echo "</span>";
    echo "<span style='width: 33%;display: inline-block;text-align: right;'>";
    echo "e-mail: " . $order->get_billing_email();
    echo "</span>";
    echo "</span>";

} else {
    echo "<span style='width: 100%;display: inline-block;'>";
    echo "<span style='width: 50%;display: inline-block;'>";
    echo "<strong style='font-size: 18px;'><i>" . $order->get_formatted_billing_full_name() . "</i></strong>";
    echo "</span>";
    echo "<span style='width: 50%;display: inline-block;text-align: right;'>";
    echo "тел. " . "<strong style='font-size: 16px;'>" . $order->get_billing_phone() . "</strong>";
    echo "</span>";
    echo "</span>";
}

echo "<span style='display: inline-block; margin: 20px 5px 20px 0;font-size: 18px;'>Доставка:</span>";
echo "<strong style='font-size: 18px;'><i>" . $order->get_shipping_method() . "</i></strong>";
echo "<br>";

$shippingMethodId = reset( $order->get_items( 'shipping' ))->get_method_id();
if ($shippingMethodId == 'u_poshta_shipping_method') {
    if ($order->get_shipping_city()) {
        echo "<span style='display: inline-block;margin: 2px 0;'><i>Населений пункт: </i><strong>" . $order->get_shipping_city() . "</strong></span><br>";
    }
    if ($order->get_shipping_state()) {
        echo "<span style='display: inline-block;margin: 2px 0;'><i>Область: </i><strong>" . $order->get_shipping_state() . "</strong></span><br>";
    }
    if ($order->get_shipping_postcode()) {
        echo "<span style='display: inline-block;margin: 2px 0;'><i>Поштовий індекс: </i><strong>" . $order->get_shipping_postcode() . "</strong></span><br>";
    }
    echo "<br>";
} else if ($shippingMethodId == 'nova_poshta_shipping') {
    if ($order->get_shipping_city()) {
        echo "<span style='display: inline-block;margin: 2px 0;'><i>Місто: </i><strong>" . $order->get_shipping_city() . "</strong></span><br>";
    }
    if ($order->get_shipping_state()) {
        echo "<span style='display: inline-block;margin: 2px 0;'><i>Область: </i><strong>" . $order->get_shipping_state() . "</strong></span><br>";
    }
    if ($order->get_shipping_address_1()) {
        echo "<span style='display: inline-block;margin: 2px 0;'><i>№ відділення: </i><strong>" . $order->get_shipping_address_1() . "</strong></span><br>";
    }
    echo "<br>";
} else {

}

echo '<h2 style="margin-top:2px;padding-bottom: 5px;border-bottom: 2px solid #000;margin-bottom: 20px;"></h2>';

$order_items = $order->get_items();
$order_items_count = $order_items ? count($order_items) : 0;
if ($order_items_count) {
    echo '<style>th, td{border: 1px solid black;}</style>';
    echo '<table style="width:100%;text-align: center;border-collapse: collapse;border: 1px solid black;margin: 30px 0 10px;">';
    echo '<tr style="text-align: center;font-size: 12px;"><td style="">Артикул</td><td>Назва товару</td><td>Колір системи</td><td>Розмір</td><td>Сторона</td><td>Ціна</td><td>Кількість</td><td>Сума</td></tr>';
    foreach($order_items as $order_item) {
        $product = wc_get_product($order_item->get_product_id());
        $variation = wc_get_product($order_item->get_variation_id());
        $standardSizes = $product ? get_field('standard_sizes', $product->get_id()) : [];

        $attribute = [];
        $attribute['sku'] = $variation ? $variation->get_sku() : $product->get_sku();
        $attribute['width'] = $order_item->get_meta("_product_attribute_width");
        $attribute['height'] = $order_item->get_meta("_product_attribute_height");
        $attribute['kolory-systemy'] = $order_item->get_meta("_product_attribute_pa_kolory-systemy");
        if ($attribute['kolory-systemy']) {
            $term_obj = get_term_by('slug', $attribute['kolory-systemy'], "pa_kolory-systemy");
            $attribute['kolory-systemy'] = $term_obj ? pll__($term_obj->name) : ucfirst($attribute['kolory-systemy']);
        }
        if (!$attribute['kolory-systemy']) {
            $attribute['kolory-systemy'] = ' - ';
        }
        $attribute['kolory-modeli'] = $order_item->get_meta("_product_attribute_pa_kolory-modeli");
        if ($attribute['kolory-modeli']) {
            $term_obj = get_term_by('slug', $attribute['kolory-modeli'], "pa_kolory-modeli");
            $attribute['kolory-modeli'] = $term_obj ? pll__($term_obj->name) : ucfirst($attribute['kolory-modeli']);
        }
        if (!$attribute['kolory-modeli']) {
            $attribute['kolory-modeli'] = ' - ';
        }
        if ($attribute['width'] && $attribute['height']) {
            $isStandardSize = false;
            if (!empty($standardSizes)) {
                foreach ($standardSizes as $standardSize) {
                    if ($attribute['width'] == $standardSize['width'] && $attribute['height'] == $standardSize['height']) {
                        $isStandardSize = true;
                        break;
                    }
                }
            }
            $attribute['width_height'] = !$isStandardSize ? ('<strong>' . $attribute['width'] . ' x ' . $attribute['height'] . '</strong>') : ($attribute['width'] . ' x ' . $attribute['height']);
        } else {
            $attribute['width_height'] = ' - ';
        }
        $attribute['storona-upravlinnya'] = $order_item->get_meta("_product_attribute_pa_storona-upravlinnya");
        if ($attribute['storona-upravlinnya']) {
            $term_obj = get_term_by('slug', $attribute['storona-upravlinnya'], "pa_storona-upravlinnya");
            $attribute['storona-upravlinnya'] = $term_obj ? pll__($term_obj->name) : ucfirst($attribute['storona-upravlinnya']);
        }
        if (!$attribute['storona-upravlinnya']) {
            $attribute['storona-upravlinnya'] = ' - ';
        }
        $attribute['product_price'] = $order_item->get_meta("_product_price") ? $order_item->get_meta("_product_price") : 0;

        echo '<tr style="font-size: 16px;">';
        echo '<td style="padding: 10px;">' . $attribute['sku'] . '</td>';
        echo '<td style="padding: 10px;">' . $order_item->get_name() . '</td>';
        echo '<td style="padding: 10px;">' . $attribute['kolory-systemy'] . '</td>';
        echo '<td style="padding: 10px;">' . $attribute['width_height'] . '</td>';
        echo '<td style="padding: 10px;">' . $attribute['storona-upravlinnya'] . '</td>';
        echo '<td style="padding: 10px;">' . strip_tags(wc_price($attribute['product_price'])) . '</td>';
        echo '<td style="padding: 10px;">' . $order_item->get_quantity() . '</td>';
        echo '<td style="padding: 10px;">' . strip_tags(wc_price($order_item->get_total())) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

echo "<span style='width: 100%;display: inline-block;'>";
echo "<span style='width: 50%;display: inline-block;'>";
echo "<span style='display: inline-block; margin: 20px 5px 20px 0;font-size: 18px;'>Оплата:</span>";
echo "<strong style='font-size: 18px;'><i>" . $order->get_payment_method_title() . "</i></strong>";
echo "</span>";
echo "<span style='width: 50%;display: inline-block;text-align: right;'>";
echo "<span style='display: inline-block; margin: 20px 5px 20px 0;font-size: 18px;'>Сума замовлення:</span>";
echo "<strong style='font-size: 18px;'><i>" . strip_tags($order->get_formatted_order_total()) . "</i></strong>";
echo "</span>";
echo "</span>";
echo "<br>";

echo "</div>";
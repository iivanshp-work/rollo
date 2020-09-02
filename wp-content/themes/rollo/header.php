<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rollo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head();
    $main_page_id = pll_get_post(2, pll_current_language('slug'));
    ?>
</head>

<body <?php body_class(); ?>>

    <header class="header">
        <!-- <header class="header login"> -->
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-4 col-3 align-self-center">
                    <div class="header__logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/logo.svg" alt="logo"></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 align-self-center">
                    <nav class="header__menu">
                        <ul class="nostyle-list">
                            <li class="showphone log">
                                <span><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/user.svg" alt="icon">
                                <?php pll_e("Особистий кабінет"); ?></span>
                                <ul class="submenu">
                                    <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                                        <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                            <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
                                        </li>

                                        <? if ($endpoint == 'orders') { ?>
                                            <li class="<?php echo wc_get_account_menu_item_classes('my-cart'); ?>">
                                                <?php global $woocommerce; ?>
                                                <a href="<?php echo $woocommerce->cart->get_cart_url() ?>"><?php echo 'Корзина' ?>
                                                    (<?php echo sprintf($woocommerce->cart->cart_contents_count); ?>)</a>
                                            </li>
                                        <? } ?>
                                    <?php endforeach; ?>
                                </ul>
                            </li>

                            <li class="showphone reg">
                                <a href="<?php echo esc_url(home_url('/')); ?>my-account/"><?php pll_e("Вхід"); ?></a>
                            </li>
                            <li class="showphone reg">
                                <a href="<?php echo esc_url(home_url('/')); ?>my-account/"><?php pll_e("Реєстрація"); ?></a>
                            </li>
                            <li>
                                <span>Каталог</span>
                                <div class="submenu megamenu">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 col-sm-4">
                                                <? while (have_rows('cat_1', $main_page_id)) : the_row();
                                                    $link = get_sub_field('punkt_menyu_kategoriyi');
                                                    $pid_link = get_sub_field('pidkategoriyi');
                                                    $thumbnail_id = get_woocommerce_term_meta($link, 'thumbnail_id', true);
                                                    $image = wp_get_attachment_url($thumbnail_id);
                                                ?>
                                                    <p class="title"><a href="<? echo get_category_link($link); ?>" data-imghov="<? echo $image; ?>" data-texthov=" <? echo get_the_category_by_ID($link); ?>">
                                                            <? echo get_the_category_by_ID($link); ?></a></p>
                                                    <ul>
                                                        <?
                                                        if ($pid_link) {
                                                            foreach ($pid_link as $link2) {
                                                                $link =  $link2['punkt'];
                                                                $link_cat =  $link2['punkt_cat'];
                                                                $thumbnail_id = get_woocommerce_term_meta($link_cat, 'thumbnail_id', true);
                                                                $image = wp_get_attachment_url($thumbnail_id);
                                                                if ($link_cat) {

                                                        ?>
                                                                    <li><a href="<? echo get_category_link($link_cat); ?>" data-imghov="<? echo $image; ?>" data-texthov=" <? echo get_the_category_by_ID($link_cat); ?>">
                                                                            <? echo get_the_category_by_ID($link_cat); ?></a></li>

                                                                <?
                                                                } else {
                                                                    $id_tovara = url_to_postid($link['url']);
                                                                ?>
                                                                    <li><a href="<? echo $link['url'] ?>" data-imghov="<? echo get_the_post_thumbnail_url($id_tovara, 'menium'); ?>" data-texthov="<? echo $link['title'] ?>">
                                                                            <? echo $link['title'] ?></a></li>


                                                        <?
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                <? endwhile;  ?>
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-4">

                                                <? while (have_rows('cat_2', $main_page_id)) : the_row();
                                                    $link = get_sub_field('punkt_menyu_kategoriyi');
                                                    $pid_link = get_sub_field('pidkategoriyi');
                                                    $thumbnail_id = get_woocommerce_term_meta($link, 'thumbnail_id', true);
                                                    $image = wp_get_attachment_url($thumbnail_id);
                                                ?>
                                                    <p class="title"><a href="<? echo get_category_link($link); ?>" data-imghov="<? echo $image; ?>" data-texthov=" <? echo get_the_category_by_ID($link); ?>">
                                                            <? echo get_the_category_by_ID($link); ?></a></p>
                                                    <ul>
                                                        <?
                                                        if ($pid_link) {
                                                            foreach ($pid_link as $link2) {
                                                                $link_cat =  $link2['punkt'];
                                                                $link =  $link2['punkt_st'];
                                                                $thumbnail_id = get_woocommerce_term_meta($link_cat, 'thumbnail_id', true);
                                                                $image = wp_get_attachment_url($thumbnail_id);
                                                                if ($link_cat) {

                                                        ?>
                                                                    <li><a href="<? echo get_category_link($link_cat); ?>" data-imghov="<? echo $image; ?>" data-texthov=" <? echo get_the_category_by_ID($link_cat); ?>">
                                                                            <? echo get_the_category_by_ID($link_cat); ?></a></li>

                                                                <?
                                                                } else {
                                                                    $id_tovara = url_to_postid($link['url']);
                                                                ?>
                                                                    <li><a href="<? echo $link['url'] ?>" data-imghov="<? echo get_the_post_thumbnail_url($id_tovara, 'menium'); ?>" data-texthov="<? echo $link['title'] ?>">
                                                                            <? echo $link['title'] ?></a></li>


                                                        <?
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                <? endwhile;  ?>

                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-4">
                                                <? while (have_rows('cat_3', $main_page_id)) : the_row();
                                                    $link = get_sub_field('punkt_menyu_kategoriyi');
                                                    $pid_link = get_sub_field('pidkategoriyi');
                                                    $thumbnail_id = get_woocommerce_term_meta($link, 'thumbnail_id', true);
                                                    $image = wp_get_attachment_url($thumbnail_id);
                                                ?>
                                                    <p class="title"><a href="<? echo get_category_link($link); ?>" data-imghov="<? echo $image; ?>" data-texthov=" <? echo get_the_category_by_ID($link); ?>">
                                                            <? echo get_the_category_by_ID($link); ?></a></p>
                                                    <ul>
                                                        <?
                                                   if ($pid_link) {
                                                    foreach ($pid_link as $link2) {
                                                        $link_cat =  $link2['punkt'];
                                                        $link =  $link2['punkt_st'];
                                                        $thumbnail_id = get_woocommerce_term_meta($link_cat, 'thumbnail_id', true);
                                                        $image = wp_get_attachment_url($thumbnail_id);
                                                        if ($link_cat) {

                                                ?>
                                                            <li><a href="<? echo get_category_link($link_cat); ?>" data-imghov="<? echo $image; ?>" data-texthov=" <? echo get_the_category_by_ID($link_cat); ?>">
                                                                    <? echo get_the_category_by_ID($link_cat); ?></a></li>

                                                        <?
                                                        } else {
                                                            $id_tovara = url_to_postid($link['url']);
                                                        ?>
                                                            <li><a href="<? echo $link['url'] ?>" data-imghov="<? echo get_the_post_thumbnail_url($id_tovara, 'menium'); ?>" data-texthov="<? echo $link['title'] ?>">
                                                                    <? echo $link['title'] ?></a></li>


                                                <?
                                                        }
                                                    }
                                                }
                                                        ?>
                                                    </ul>
                                                <? endwhile;  ?>
                                            </div>

                                            <div class="col-lg-3 col-md-12">
                                                <div class="header__categorypic">
                                                    <figure>
                                                        <div>
                                                            <img src="" alt="">
                                                        </div>
                                                        <p class="category-name"></p>
                                                    </figure>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <span><?php pll_e("Інформація"); ?></span>
                                <ul class="submenu">
                                    <? while (have_rows('menyu_informacziya', $main_page_id)) : the_row();
                                        $link = get_sub_field('item'); ?>
                                        <li><a href="<? echo $link['url'] ?>"><? echo $link['title'] ?></a></li>
                                    <? endwhile;    ?>
                                </ul>
                            </li>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>blog/">Блог</a></li>
                            <li>
                                <span><?php pll_e("Про нас"); ?></span>
                                <ul class="submenu sub_about">
                                    <? while (have_rows('menyu_about', $main_page_id)) : the_row();
                                        $link = get_sub_field('item'); ?>
                                        <li><a href="<? echo $link['url']; ?>"><? echo $link['title'] ?></a></li>
                                    <? endwhile; ?>
                                </ul>
                            </li>
                            <li>
                                <a class="header_phone" href="tel:<? the_field('telefon', $main_page_id); ?>">
                                    <? the_field('telefon', $main_page_id); ?></a>
                            </li>

                        </ul>
                    </nav>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2 col-4">
                    <div class="header__lang">
                        <ul>
                            <?php pll_the_languages(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-7 col-5 align-self-center text-right">
                    <div class="header__search">

                        <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/search.svg" alt="search">
                        <?php get_product_search_form(); ?>

                    </div>
                    <div class="header__basket">
                        <?php global $woocommerce; ?>
                        <a href="<?php echo $woocommerce->cart->get_cart_url() ?>">
                            <div class="basket__box">
                                <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/shopping-basket.svg" alt="basket">
                                <span class="basket__icon basket-btn__counter"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
                            </div>
                        </a>
                    </div>



                    <div class="header__login">
                        <ul class="nostyle-list">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>my-account/"><?php pll_e("Вхід"); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>my-account/"><?php pll_e("Реєстрація"); ?></a></li>
                        </ul>
                        <ul class="nostyle-list loginuser-listmenu">
                            <li>
                                <span><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/user.svg" alt="icon">
                                    Особистий кабінет</span>
                                <ul class="submenu">
                                    <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                                        <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                            <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
                                        </li>

                                        <? if ($endpoint == 'orders') { ?>
                                            <li class="<?php echo wc_get_account_menu_item_classes('my-cart'); ?>">
                                                <?php global $woocommerce; ?>
                                                <a href="<?php echo $woocommerce->cart->get_cart_url() ?>"><?php echo 'Корзина' ?>
                                                    (<?php echo sprintf($woocommerce->cart->cart_contents_count); ?>)</a>
                                            </li>
                                        <? } ?>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="burger"></div>
                </div>
            </div>
        </div>
    </header>

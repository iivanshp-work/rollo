<?php
/**
 * The template for displaying all pages
 
 Template Name: Home page
 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rollo
 */

get_header();
?>

<main>
    <section class="hometop-section">
        <div class="main-social">
        <? $soc = get_field('soczialky', $main_page_id); ?>
            <ul class="nostyle-list">
                <li>
                    <a href="<? echo $soc['fejsbuk']; ?>" target="_blank">
                        <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/facebook-icon.svg"
                            alt="facebook">
                    </a>
                </li>
                <li>
                    <a href="<? echo $soc['instagram']; ?>" target="_blank">
                        <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/instagram-icon.svg"
                            alt="instagram">
                    </a>
                </li>
                <li>
                    <a href="<? echo $soc['yutub']; ?>" target="_blank">
                        <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/youtube-icon.svg"
                            alt="youtube">
                    </a>
                </li>
            </ul>
        </div>
        <div class="home-slider">
        <? while (have_rows('slajder')) : the_row();
		    $link = get_sub_field('posylannya'); ?>
            <div style="background-image: url(<? the_sub_field('img');?>);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-9">
                            <p class="home-slider__title"><? the_sub_field('slider_title');?></p>
                            <p class="home-slider__description"><? the_sub_field('slider_description');?></p>
                            <a href="<? echo $link['url'] ?>" class="home-slider__link"><? echo $link['title'] ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <? endwhile;   ?>

        </div>
    </section>

    <section class="products-section">
        <div class="container">
            <div class="row">
                <? $taxonomy     = 'product_cat';
                    $show_count   = 0;      // 1 for yes, 0 for no
                    $pad_counts   = 0;      // 1 for yes, 0 for no
                    $hierarchical = 1;      // 1 for yes, 0 for no 
                    $title        = ''; 
                    $empty        = 0;
                    $args = array(
                    'taxonomy'     => $taxonomy,
                    'orderby'      => $orderby,
                    'show_count'   => $show_count,
                    'pad_counts'   => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li'     => $title,
                    'hide_empty'   => $empty,
                    );
                    $all_categories = get_categories( $args );
                    foreach ($all_categories as $cat) {
                        if($cat->category_parent == 0) {
                            $category_id = $cat->term_id;
                                //echo '<li><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a></li>';
                                $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                                $image = wp_get_attachment_url( $thumbnail_id );
                                //echo '<img class="category-thumb" src="' . $image . '" alt="" />';?>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="productbox">
                                            <a href="<? echo  get_term_link($cat->slug, 'product_cat'); ?>">
                                                <div class="productbox__pic">
                                                    <img src="<? echo $image; ?>" alt="product">
                                                </div>
                                                <div class="productbox__description">
                                                    <span class="arrowlink"></span>
                                                    <p class="title">
                                                        <?echo $cat->name?>
                                                    </p>
                                                    <p class="number">
                                                        <?echo $cat->count; ?> моделей</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?
                    }    
                    }?>
            </div>
        </div>
    </section>

    <section class="blackinfo-section">
        <div class="container">
            <p class="blackinfo-section__title"><? the_field('how_title'); ?></p>
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-sect">
                        <p><? the_field('how_desc'); ?></p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row right-sect">
        <? while (have_rows('how_infoboxes')) : the_row(); ?>
            <div class="infobox col-md-4 col-sm-4">
                            <div class="infobox__pic">
                                <img src="<? the_sub_field('ico'); ?>" alt="image">
                            </div>
                            <p class="title"><? the_sub_field('zagolovok'); ?></p>
                            <p class="description">
                            <? the_sub_field('opys'); ?>
                            </p>
                        </div>

            <? endwhile;   ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="buy-section">
        <div class="container">
            <div class="buy-section__box">
                <div class="buy-section__textblock">
                    <h4><? the_field('buy_title'); ?></h4>
                    <p><? the_field('buy_title_sub'); ?></p>
                    <a href="<? $link = get_field( 'buy_title_link'); echo $link['url'] ?>"> <? echo $link['title'] ?> </a>
                </div>
            </div>
        </div>
    </section>

    <section class="whywe">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-12">
                    <div class="whywe__pic">
                        <img src="<? the_field('why_img');?>" alt="image">
                        <p><span><? the_field('why_img_subscr');?></span></p>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1 col-md-7 col-sm-12">
                    <div class="whywe__text">
                        <h3><? the_field('why_title');?></h3>
                        <?php
                            while ( have_posts() ) :
                                the_post();
                                the_content();
                            endwhile; 
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
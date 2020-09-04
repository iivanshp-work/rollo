<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package rollo
 */

get_header();

?>

<main>

    <section class="search-section">
        <div class="container">
            <div class="row">
                <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-0 col-lg-10 col-md-10 col-sm-12 search-section-top">
                    <img class="search-img" src="<? echo get_template_directory_uri() . '/assets/' ?>image/search-cat.png">
                    <div class="search-title-wrapper">
                        <div class="search-title">404</div>
                        <div class="search-subtitle"><?php pll_e("еххх...знову в нас тут виникли помилки"); ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-0 col-lg-10 col-md-10 col-sm-12 search-section-bottom">
                    <form id="searchform" role="search" method="get" class="search-form" action="/">
                        <input type="text" id="woocommerce-product-search" class="search-field" placeholder="<?php pll_e("Пошук…"); ?>" value="" name="s">
                        <button type="submit"><?php pll_e("Шукати"); ?></button>
                        <input type="hidden" name="post_type" value="product">
                    </form>
                </div>
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
                $all_categories = get_categories($args);
                foreach ($all_categories as $cat) {
                    if ($cat->category_parent == 0) {
                        //if(true) {
                        $category_id = $cat->term_id;
                        //echo '<li><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a></li>';
                        $thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);
                        //echo '<img class="category-thumb" src="' . $image . '" alt="" />';
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="productbox">
                                <a href="<? echo  get_term_link($cat->slug, 'product_cat'); ?>">
                                    <div class="productbox__pic">
                                        <img src="<? echo $image; ?>" alt="product">
                                    </div>
                                    <div class="productbox__description">
                                        <span class="arrowlink"></span>
                                        <p class="title">
                                            <? echo $cat->name ?>
                                        </p>
                                        <p class="number">
                                            <? echo $cat->count; ?> <?php pll_e("моделей"); ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?
                    }
                } ?>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
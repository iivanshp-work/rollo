<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rollo
 */

get_header();

while ( have_posts() ) :
			the_post();
?>

<main id="post-<?php the_ID(); ?>">
    <div class="breadcrums">
        <div class="container">
        <? 	get_template_part( 'template-parts/bread'); ?>
        </div>
    </div>
    <section class="blogopen-page">
        <div class="container">
            <h1 class="blogopen-page__title">
                <? the_title(); ?>
            </h1>
            <p class="blogopen-page__date">
                <? the_date(); ?>
            </p>

            <img src="<? echo get_the_post_thumbnail_url( $id, 'full' ); ?>" alt="">

            <div class="blogopen__content">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <? the_content(); ?>
                    </div>
                </div>
            </div>
            <div class="blogopen__nav">
                <div class="row">
                    <div class="col-sm-6 col-6">
                        <? $next_post = get_previous_post(); if ($next_post) {?>
                        <div class="blogopen__navleft">
                            <a href="<?php echo get_permalink( $next_post ); ?>">
                                <text><?php echo esc_html($next_post->post_title); ?></text>
                                <span></span>
                            </a>
                        </div>
                        <?}?>
                    </div>
                    <div class="col-sm-6 col-6">
                        <? $next_post = get_next_post(); if ($next_post) {?>
                        <div class="blogopen__navright">
                            <a href="<?php $next_post = get_next_post(); echo get_permalink( $next_post ); ?>">
                                <span></span>
                                <text><?php echo esc_html($next_post->post_title); ?></text>
                            </a>
                        </div>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>


<?

endwhile; // End of the loop.
?>



<?php
get_footer();

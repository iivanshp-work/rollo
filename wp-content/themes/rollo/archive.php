<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rollo
 */

get_header();
?>

<main>
    <div class="breadcrums">
        <div class="container">
            <? 	get_template_part( 'template-parts/bread'); ?>
        </div>
    </div>
    <section class="blog-page">

        <div class="container">
            <h1 class="page-linetitle" style="margin-top: 0;"><?php pll_e("Блог")?></h1>
            <div class="row">
                <?php $num_post = 0; if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                $num_post++;
                switch ($num_post) {
                    case 1:
                        ?>
                <div class="col-12">
                    <a href="<? the_permalink(); ?>">
                        <div class="bigpost">
                            <img src="<? echo get_the_post_thumbnail_url( $id, 'full' ); ?>" alt="">
                            <div class="bigpost__text">
                                <p>
                                    <? the_title(); ?>
                                </p>
                                <span>
                                    <? the_date(); ?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <?
                    break;
                    case 4:
                        ?>
                <div class="col-12">
                    <a href="<? the_permalink(); ?>">
                        <div class="bigpost bigpost_right">
                            <img src="<? echo get_the_post_thumbnail_url( $id, 'full' ); ?>" alt="">
                            <div class="bigpost__text">
                                <p>
                                    <? the_title(); ?>
                                </p>
                                <span>
                                    <? the_date(); ?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <?

                    break;

                    default:
    ?>
                <div class="col-md-6">
                    <a href="<? the_permalink(); ?>">
                        <div class="littpost">
                            <div class="littpost__pic">
                                <img src="<? echo get_the_post_thumbnail_url( $id, 'large' ); ?>" alt="">
                            </div>
                            <div class="littpost__descr">
                                <p class="title">
                                    <? the_title(); ?>
                                </p>
                                <p class="descr">
                                    <? echo mb_substr(wp_filter_nohtml_kses(get_the_content()), 0, 240, "utf-8"); ?>...
                                </p>
                                <p class="date">
                                    <? the_date(); ?>
                                </p>
								</div>
                        </div>
                    </a>
                </div>
                <?
                    } //end switch
                ?>

                <?


			endwhile;

		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>





            </div>
            <? $args = array(
                'show_all'           => true,
                'end_size'           => 1,
                'mid_size'           => 2,
                'prev_next'          => false,
                'add_args'           => false,
                'type'         => 'list',
                'add_fragment'       => '',
                'screen_reader_text' => __( 'Posts navigation' ),
            );            ?>

<div class="pagination">
                <ul class=" nostyle-list">
                    <? echo paginate_links( $args ); ?>
                </ul>
            </div>
        </div>
    </section>

</main>





<?php

get_footer();

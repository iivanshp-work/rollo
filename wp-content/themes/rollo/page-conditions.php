<?php

/**
    Template Name: Умови сайту
 */
get_header();
?>
<main>
<div class="breadcrums">
        <div class="container">
        <? 	get_template_part( 'template-parts/bread'); ?>
        </div>
    </div>
        <section class="condition-topsect">
            <div class="container">
                <h1 class="page-linetitle"><?php the_title(); ?></h1>
                <p><? the_field("main-description"); ?></p>
            </div>
        </section>
        <section class="measure__accordeon conditions__accordeon">
            <div class="container">
            <?php
                $num_row;
                if (have_rows('conditions')) :
                    while (have_rows('conditions')) : the_row();
                        if ($num_row != 0) {
                            ?>
                <div class="measure__accblock">
                    <div class="measure__acctitle">
                        <span class="text"><? the_sub_field('condition-title'); ?></span>
                        <span class="icon"></span>
                    </div>
                    <div class="measure__accdescription">
                        <div class="row">
                            <div class="col-12">
                                <p><? the_sub_field('condition-description'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    } else {
                ?>
                <div class="measure__accblock active shadow">
                    <div class="measure__acctitle">
                        <span class="text"><? the_sub_field('condition-title'); ?></span>
                        <span class="icon"></span>
                    </div>
                    <div class="measure__accdescription">
                        <div class="row">
                            <div class="col-12">
                                <p><? the_sub_field('condition-description'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                        $num_row++;
                    endwhile;
                endif;
                ?>
            </div>
        </section>

    </main>
<?php
get_footer();

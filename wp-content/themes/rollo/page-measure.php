<?php

/**
    Template Name: Замір
 */
get_header();
?>

<main>
        <div class="breadcrums">
<div class="breadcrums">
        <div class="container">
        <? 	get_template_part( 'template-parts/bread'); ?>
        </div>
    </div>
        </div>
        <section class="measure__topsect">
            <div class="grey-bgbox"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="measure__title"><?php the_title(); ?></h1>
                        <p class="measure__descr"><? the_field('main-decription'); ?></p>
                    </div>
                    <div class="col-lg-6">
                        <div class="embed-responsive">
                            <!-- <iframe class="embed-responsive-item"
                                src="https://www.youtube.com/embed/6GFvUCcljkM"></iframe> -->
                            <iframe class="embed-responsive-item" src=""
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="measure__accordeon">
            <div class="container">
            <?php
                $num_row;
                if (have_rows('measures')) :
                    while (have_rows('measures')) : the_row();
                        if ($num_row != 0) {
                            ?>
                <div class="measure__accblock">
                    <div class="measure__acctitle">
                        <span class="text"><? the_sub_field('measure-title'); ?></span>
                        <span class="icon"></span>
                    </div>
                    <div class="measure__accdescription">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="acc-texts">
                                    <p><? the_sub_field('measure-text1'); ?></p>
                                    <p><? the_sub_field('measure-text2'); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img class="acc-pic" src="<? the_sub_field('measure-img'); ?>" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    } else {
                ?>
                <div class="measure__accblock active shadow">
                    <div class="measure__acctitle">
                        <span class="text"><? the_sub_field('measure-title'); ?></span>
                        <span class="icon"></span>
                    </div>
                    <div class="measure__accdescription">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="acc-texts">
                                    <p><? the_sub_field('measure-text1'); ?></p>
                                    <p><? the_sub_field('measure-text2'); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img class="acc-pic" src="<? the_sub_field('measure-img'); ?>" alt="image">
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

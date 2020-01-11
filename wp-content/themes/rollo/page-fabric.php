<?php

/**
    Template Name: Про тканини
 */
get_header();
?>
 <main>
<div class="breadcrums">
        <div class="container">
        <? 	get_template_part( 'template-parts/bread'); ?>
        </div>
    </div>
        <div class="fabric-topsect">
            <div class="container">
                <p class="page-linetitle"><?php the_title(); ?></p>
            </div>
        </div>
        <section class="measure__accordeon conditions__accordeon">
            <div class="container">
            <?php
                $num_row;
                if (have_rows('fabric-list')) :
                    while (have_rows('fabric-list')) : the_row();
                        if ($num_row != 0) {
                            ?>
                <div class="measure__accblock">
                    <div class="measure__acctitle">
                        <span class="text"><? the_sub_field('fabric-title'); ?></span>
                        <span class="icon"></span>
                    </div>
                    <div class="measure__accdescription">
                        <div class="row">
                            <div class="col-12">
                                <p class="accordeon-titcont"><? the_sub_field('fabric-subtitle'); ?></p>
                                <p><? the_sub_field('fabric-description'); ?></p>
                                <div class="infblock">
                                    <p class="accordeon-titcont"><? the_sub_field('characteristic-title'); ?></p>
                                    <div class="row">
                                        <?php
                                        if (have_rows('characteristic-list')) :
                                            while (have_rows('characteristic-list')) : the_row();
                                                ?>
                                        <div class="col-lg-4">
                                            <div class="infblock__box">
                                                <img src="<? the_sub_field('characteristic-img'); ?>" alt="icon">
                                                <div class="infblock__boxtext">
                                                    <p class="title"><? the_sub_field('characteristic'); ?></p>
                                                    <p class="descr"><? the_sub_field('addfield'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                endwhile;
                                            endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <?php
                    } else {
                ?>
                <div class="measure__accblock active shadow">
                    <div class="measure__acctitle">
                        <span class="text"><? the_sub_field('fabric-title'); ?></span>
                        <span class="icon"></span>
                    </div>
                    <div class="measure__accdescription">
                        <div class="row">
                            <div class="col-12">
                                <p class="accordeon-titcont"><? the_sub_field('fabric-subtitle'); ?></p>
                                <p><? the_sub_field('fabric-description'); ?></p>
                                <div class="infblock">
                                    <p class="accordeon-titcont"><? the_sub_field('characteristic-title'); ?></p>
                                    <div class="row">
                                        <?php
                                        if (have_rows('characteristic-list')) :
                                            while (have_rows('characteristic-list')) : the_row();
                                                ?>
                                        <div class="col-lg-4">
                                            <div class="infblock__box">
                                                <img src="<? the_sub_field('characteristic-img'); ?>" alt="icon">
                                                <div class="infblock__boxtext">
                                                    <p class="title"><? the_sub_field('characteristic'); ?></p>
                                                    <p class="descr"><? the_sub_field('addfield'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                endwhile;
                                            endif;
                                        ?>
                                    </div>
                                </div>
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
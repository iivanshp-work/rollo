<?php

/**
    Template Name: Контакти
 */
get_header();
?>
<main>
<div class="breadcrums">
        <div class="container">
        <? 	get_template_part( 'template-parts/bread'); ?>
        </div>
    </div>
    <section class="contactsmap">
        <div class="abscont-title">
            <div class="container">
                <p class="contact-form__title"><?php the_title(); ?></p>
            </div>
        </div>
        <div id="map"></div>
    </section>
    <section class="contact-form">
        <div class="container">
            <div class="contact-formbox">
                <div class="row no-gutters">
                    <div class="col-cont-5">
                        <div class="leftcont">
                            <div class="cont-info">
                                <? $adress = get_field('adress'); ?>
                                <img src="<? echo $adress['adress-icon']; ?>" alt="icon">
                                <p class="title">
                                    <? echo $adress['adress-title']; ?>
                                </p>
                                <p class="descr">
                                    <? echo $adress['adress-description']; ?>
                                </p>
                            </div>
                            <div class="cont-info">
                                <? $mail = get_field('mail'); ?>
                                <img src="<? echo $mail['mail-icon']; ?>" alt="icon">
                                <p class="title">
                                    <? echo $mail['mail-title']; ?>
                                </p>
                                <a href="mailto:info@rollo.lviv.ua" class="descr">
                                    <? echo $mail['mail-description']; ?></a>
                            </div>
                            <div class="cont-info">
                                <? $phone = get_field('phone'); ?>
                                <img src="<? echo $phone['phone-icon']; ?>" alt="icon">
                                <p class="title">
                                    <? echo $phone['phone-title']; ?>
                                </p>
                                <p class="descr">
                                    <? echo $phone['phone-description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="rightcont">
                            <p class="title"><?php the_field('form-title'); ?></p>
                            <?php echo do_shortcode(' [contact-form-7 id="' . get_field('forma_napysaty_nam') . '" html_class="form-section"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="whowe">
        <div class="container">
            <p class="whowe__title"><?php the_field('title'); ?></p>
            <p><?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?></p>
        </div>
    </section>
</main>
<?php
get_footer();
<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rollo
 */
$main_page_id = pll_get_post(2, pll_current_language('slug'));
?>

<footer class="footer">
    <div class="footfig">
        <p>
            <span>
                <? the_field('kopirajt', $main_page_id); ?></span>
        </p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="footer__leftblock">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<? the_field('logo-futter', $main_page_id); ?>" alt="logo"></a>
                    <ul class="footer__contacts nostyle-list">
                        <li><a href="mailto:<? the_field('emajl', $main_page_id); ?>">
                                <? the_field('emajl', $main_page_id); ?></a></li>
                        <li><a href="tel:<? the_field('telefon', $main_page_id); ?>">
                                <? the_field('telefon', $main_page_id); ?></a></li>
                    </ul>
                    <? $soc = get_field('soczialky', $main_page_id); ?>
                    <ul class="nostyle-list footer__social">
                        <li><a href="<? echo $soc['fejsbuk']; ?>"><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/facebook-footer.svg" alt="icon"></a></li>
                        <li><a href="<? echo $soc['instagram']; ?>"><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/instagram-footer.svg" alt="icon"></a></li>
                        <li><a href="<? echo $soc['yutub']; ?>"><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/youtube-footer.svg" alt="icon"></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="footer__rightblock">
                    <div>
                        <p class="title"><?php pll_e("Товари"); ?></p>
                        <ul class="nostyle-list">
                            <? get_top_cat(); ?>
                        </ul>

                    </div>
                    <div>
                        <p class="title">
                            <?php pll_e("Інформація"); ?>
                        </p>
                        <ul class="nostyle-list">
                            <? while (have_rows('menyu_informacziya', $main_page_id)) : the_row();
                                $link = get_sub_field('item'); ?>
                                <li><a href="<? echo $link['url'] ?>">
                                        <? echo $link['title'] ?> </a></li>
                            <? endwhile;    ?>
                        </ul>
                    </div>
                    <div>
                        <p class="title">
                            <?php pll_e("Про нас"); ?>
                        </p>
                        <ul class="nostyle-list">
                            <? while (have_rows('menyu_about', $main_page_id)) : the_row();
                                $link = get_sub_field('item'); ?>
                                <li><a href="<? echo $link['url'] ?>">
                                        <? echo $link['title'] ?> </a></li>
                            <? endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/jquery.min.js"></script>
<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/slick.min.js"></script>
<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/slick-lightbox.js"></script>
<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/jquery.formstyler.min.js"></script>
<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/jquery.inputmask.min.js"></script>
<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/jquery.parallax.min.js"></script>

<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/rangeslider.min.js"></script>
<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/lightzoom.min.js"></script>

<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/common.js"></script>
<script>var home_slider_next_btn_text = '<?php pll_e("наступний"); ?>';</script>
<script src="<? echo get_template_directory_uri() . '/assets/' ?>js/custom.js"></script>


<? global $post;
if ($post->post_name == 'kontakty') { ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUk7hCors1DO6D8nnECHhjVyDvOqosuzU&callback=initMap">
    </script>
<? } ?>
</body>

</html>
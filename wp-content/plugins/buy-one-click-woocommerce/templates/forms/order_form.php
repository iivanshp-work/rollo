<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<?php
/**
 * Шаблон формы быстрого заказа
 */
?>
<div id="formOrderOneClick">
    <?php
    if ($field['variation_plugin']) {
        \BuyVariationClass::viewJs();
    }
    ?>
    <div class="overlay" title=""></div>
    <div class="popup">
        <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/cancel.svg" alt="cancel" class="close_order">
        <form id="buyoneclick_form_order" class="b1c-form" method="post" action="#">
            <p class="title"><?php echo pll__('Замовити в 1 клік') . ($field['product_name'] ? (" - " . $field['product_name']) : '');?></p>

            <p class="form-message-result"></p>

            <?php if (!empty($options['buyoptions']['fio_chek'])) { ?>
              <div class="inpinline-field">
                <label for="txtname"><?php echo pll__("Ім’я та прізвище"); ?><abbr class="required" title="обов'язкове">*</abbr></label>
                <input class="buyvalide <?php echo ($field['is_template_style'] ? 'input-text' : '') ?>" type="text" <?php ?> placeholder="" name="txtname">
              </div>
            <?php } ?>
            <?php if (!empty($options['buyoptions']['fon_chek'])) { ?>
              <div class="inpinline-field">
                <label for="txtphone"><?php echo pll__("Телефон"); ?><abbr class="required" title="обов'язкове">*</abbr></label>
                <input class="buyvalide <?php echo ($field['is_template_style'] ? 'input-text' : '') ?> " type="tel" <?php ?> placeholder="" name="txtphone">
                <p class="phoneFormat"><?php
                    if (!empty($options['buyoptions']['fon_format'])) {
                        echo __('Format', 'coderun-oneclickwoo') . ' ' . $options['buyoptions']['fon_format'];
                    }
                    ?></p>
              </div>
            <?php } ?>
            <?php if (!empty($options['buyoptions']['email_chek'])) { ?>
              <div class="inpinline-field">
                <label for="txtphone"><?php echo pll__("Email"); ?></label>
                <input class="buyvalide <?php echo ($field['is_template_style'] ? 'input-text' : '') ?> " type="email" <?php ?> placeholder="" name="txtemail">
              </div>
            <?php } ?>
            <?php if (!empty($options['buyoptions']['dopik_chek'])) { ?>
                <labe for="message"><?php echo pll__("Опис"); ?></labe>
                <textarea class="buymessage buyvalide" <?php ?> name="message" placeholder="<?php echo $options['buyoptions']['dopik_descript']; ?>" rows="2" value=""></textarea>
            <?php } ?>

            <?php if (!empty($options['buyoptions']['conset_personal_data_enabled'])) { ?>
                <p>
                    <input type="checkbox" name="conset_personal_data">
                    <?php echo $options['buyoptions']['conset_personal_data_text']; ?>
                </p>
            <?php } ?>

            <?php wp_nonce_field('one_click_send','_coderun_nonce'); ?>
            <input type="hidden" name="nametovar" value="<?php echo $field['product_name']; ?>" />
            <input type="hidden" name="pricetovar" value="<?php echo $field['product_price']; ?>" />
            <input type="hidden" name="idtovar" value="<?php echo $field['product_id']; ?>" /> 
            <input type="hidden" name="action" value="coderun_send_form_buy_one_click_buybuttonform" />
            <input type="hidden" name="custom" value="<?php echo $field['form_custom']; ?>"/>

            <?php
            //Форма файлов
            echo $field['html_form_file_upload'];

            if(!empty($options['buyoptions']['recaptcha_order_form'])) {
                Coderun\BuyOneClick\ReCaptcha::getInstance()->view($options['buyoptions']['recaptcha_order_form']);
            }

            ?>

            <button 
                type="submit" 
                class="button alt buyButtonOkForm ld-ext-left"
                name="btnsend">
                <span> <?php echo pll__('Оформити замовлення'); ?></span>
                <div style="font-size:14px" class="ld ld-ring ld-cycle"></div>
            </button>

        </form>

    </div>
    <?php
    if (!empty($options['buyoptions']['success_action'])) {
        ?>
        <div class = "overlay_message" title = "<?php _e('Notification', 'coderun-oneclickwoo'); ?>"></div>
        <div class = "popummessage">
            <img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/cancel.svg" alt="cancel" class="close_order">
            <p class="title"><?php echo pll__("Дякуємо. Ваше замовлення було отримано."); ?></p>
        </div>
        <?php
    }
    ?>
</div>
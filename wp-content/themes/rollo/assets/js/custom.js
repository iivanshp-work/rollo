$(document).ready(function () {
    // input slyled
    $(function () {
        if($('.woocommerce-checkout #np_custom_address').length) {
            $('.woocommerce-checkout #np_custom_address').after('<span class="custom-checkbox"></span>')
        }
    });

    $(document).on('click', '[data-pa-type]', function(e){
        let type = $(this).data('pa-type');
        let id = $(this).data('id');
        $(this).parent().parent().find('.active').removeClass('active');
        $(this).addClass('active');
        $('[data-product_attribute="' + type + '"]').val(id).trigger('change');
    });

    if ($('[data-pa-type].selected_variation').length) {
        $('[data-pa-type].selected_variation').click().trigger('click');
        recalculatePrice();
    }

    $(document).on('change', '[data-product-color-popup]', function(e){
        $('[data-product_attribute="pa_kolory-modeli"]').val($(this).val()).trigger('change');
    });

    $(document).on('click', '[data-pa-type-popup]', function(e){
        let type = $(this).data('pa-type-popup');
        let id = $(this).data('id');
        let obj = $(this);
        obj.parent().parent().find('.active').removeClass('active');
        obj.addClass('active');

        let mainObj = $('[data-pa-type="' + type + '"][data-id="' + id + '"]');
        mainObj.parent().parent().find('.active').removeClass('active');
        mainObj.addClass('active');

        $('[data-product_attribute="' + type + '"]').val(id).trigger('change');
        $(this).parents('.modal-section').fadeOut();

        setTimeout(function(){
            obj.parent().parent().find('.active').removeClass('active');
        }, 1000);
    });

    $(document).on('click', '[data-product-standard-sizes]', function(e){
        let width = $(this).data('width');
        let height = $(this).data('height');
        $('.newswidth text').html(width);
        $('.newsheight text').html(height);
        //$('.sizelist').addClass('littheight');
        $(".settblock.new-size, .sizelist__boxnew .sizelist__row").show();
        $('[data-product_attribute="width"]').val(width).trigger('change');
        $('[data-product_attribute="height"]').val(height).trigger('change');
    });

    $(document).on('click', '#product_form .delete-size', function(e){
        $('[data-product_attribute="width"]').val('0').trigger('change');
        $('[data-product_attribute="height"]').val('0').trigger('change');
    });

    $(document).on('change', '[data-product_attribute].recalculate_price', function(e){
        console.log('recalculate');
        recalculatePrice();
    });

    $(document).on('submit', '#product-review-form', function(e){
        e.preventDefault();
        let frm = $('#product-review-form');
        let wrapper = frm;

        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");
        //
        let data = frm.serialize();
        data = data ? data + '&action=product_review' : 'action=product_review';
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function() {
                frm.find('input[type="submit"]').attr('disabled', 'disabled');
            },
            success: function(data) {
                if (data.has_error) {
                    frm.find('.fieldset .error').remove();
                    frm.find('.fieldset').prepend('<div class="error">' + data.message + '</div>');
                } else {
                    frm.find('.fieldset').hide();
                    frm.find('.title').css('margin-bottom', 0).text(data.message);
                }
            },
            complete: function(){
                wrapper.data("busy", false).removeClass("busy");
                frm.find('input[type="submit"]').removeAttr('disabled');
            }
        });

    });

    $(document).on('click', '#product_form [data-add-to-cart]', function(e) {
        e.preventDefault();
        let btn = $(this);
        let frm = $('#product_form');
        let product_id = frm.find('[name="product_id"]').val();
        let wrapper = frm;

        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");

        let data = frm.serialize();
        data = data ? data + '&action=ajax_add_to_cart' : 'action=ajax_add_to_cart';
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function() {
                btn.attr('disabled', 'disabled');
                if ($('.post-'+product_id).length) {
                    titleClass = '.post-'+product_id+' .page-linetitle';
                } else {
                    titleClass = '.postid-'+product_id+' .page-linetitle';
                }
            },
            success: function(data) {
                wrapper.find('.error').remove();
                if (data.has_error) {
                    if (data.show_select_color_popup != undefined) {
                        $('.modal-section-available-colors').fadeIn();
                    } else {
                        $(titleClass).after('<div class="error">' + data.error_message + '</div>');
                    }

                } else if (data.html != undefined) {
                    //show html popup
                    $('.modal-section-cart-popup').remove();
                    $('body').append(data.html);
                    $('.modal-section-cart-popup').fadeIn();
                } else {
                    //redirect to checkout;
                    window.location = data.redirect_link;
                }
            },
            complete: function(){
                wrapper.data("busy", false).removeClass("busy");
                btn.removeAttr('disabled');
                $(wrapper).find('.loader').remove();
            }
        });
    });
    $(document).on('click', '.woocommerce-checkout [data-remove-cart-item]', function(e) {
        let btn = $(this);
        let cart_item_key = btn.data('cart-item-key');
        let wrapper = $('.woocommerce-checkout-review-order-table');
        let woocommerceFrm = $('form.woocommerce-checkout');
        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");

        data = {
            action: 'product_remove',
            cart_item_key: cart_item_key,
        };
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function() {

            },
            success: function(data) {
                if (data.has_error) {
                    woocommerceFrm.find('.woocommerce-NoticeGroup-checkout').remove();
                    let html = '<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout"><ul class="woocommerce-error" role="alert"><li>' + data.error_message + '</li></ul></div>';
                    woocommerceFrm.prepend(html);
                } else {
                    $('.header .basket-btn__counter').text(data.total_products);
                    if (!data.total_products) {
                        window.location = window.location;
                    } else {
                        if ( data && data.fragments ) {
                            $.each( data.fragments, function ( key, value ) {
                                $(key).replaceWith(value);
                            } );
                        }
                    }
                }
            },
            complete: function(){
                wrapper.data("busy", false).removeClass("busy");
            }
        });

        if ( data && data.fragments ) {
            $.each( data.fragments, function ( key, value ) {
                $( key ).replaceWith( value );
                $( key ).unblock();
            } );
        }
    });

    $(document).on('click', '.woocommerce-checkout [data-quantity-cart-item]', function(e) {
        let btn = $(this);
        let cart_item_key = btn.data('cart-item-key');
        let quantity = btn.data('quantity-cart-item');
        let wrapper = $('.woocommerce-checkout-review-order-table');
        let woocommerceFrm = $('form.woocommerce-checkout');

        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");

        data = {
            action: 'set_quantity',
            cart_item_key: cart_item_key,
            quantity: quantity,
        };
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function() {

            },
            success: function(data) {
                if (data.has_error) {
                    woocommerceFrm.find('.woocommerce-NoticeGroup-checkout').remove();
                    let html = '<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout"><ul class="woocommerce-error" role="alert"><li>' + data.error_message + '</li></ul></div>';
                    woocommerceFrm.prepend(html);
                } else {
                    $('.header .basket-btn__counter').text(data.total_products);
                    if (!data.total_products) {
                        window.location = window.location;
                    } else {
                        if ( data && data.fragments ) {
                            $.each( data.fragments, function ( key, value ) {
                                $(key).replaceWith(value);
                            } );
                        }
                    }
                }
            },
            complete: function(){
                wrapper.data("busy", false).removeClass("busy");
            }
        });

        if ( data && data.fragments ) {
            $.each( data.fragments, function ( key, value ) {
                $( key ).replaceWith( value );
                $( key ).unblock();
            } );
        }
    });

    /*popup simple cart*/
    $(document).on('click', '.modal-section-cart-popup [data-remove-cart-item]', function(e) {
        let btn = $(this);
        let cart_item_key = btn.data('cart-item-key');
        let wrapper = $('.woocommerce-checkout-review-order-table');
        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");

        data = {
            action: 'product_remove',
            cart_item_key: cart_item_key,
        };
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function() {

            },
            success: function(data) {
                if (data.has_error) {
                    wrapper.find('.woocommerce-NoticeGroup-checkout').remove();
                    let html = '<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout"><ul class="woocommerce-error" role="alert"><li>' + data.error_message + '</li></ul></div>';
                    wrapper.prepend(html);
                } else {
                    $('.header .basket-btn__counter').text(data.total_products);
                }
            },
            complete: function(){
                wrapper.data("busy", false).removeClass("busy");
                $('.modal-section-cart-popup').fadeOut();
            }
        });
    });

    $(document).on('click', '.modal-section-cart-popup [data-quantity-cart-item]', function(e) {
        let btn = $(this);
        let cart_item_key = btn.data('cart-item-key');
        let quantity = btn.data('quantity-cart-item');
        let mode = btn.data('mode');
        let wrapper = $('.woocommerce-checkout-review-order-table');
        let woocommerceFrm = $('form.woocommerce-checkout');

        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");

        data = {
            action: 'set_quantity',
            cart_item_key: cart_item_key,
            quantity: quantity,
        };
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function() {

            },
            success: function(data) {
                if (data.has_error) {
                    wrapper.find('.woocommerce-NoticeGroup-checkout').remove();
                    let html = '<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout"><ul class="woocommerce-error" role="alert"><li>' + data.error_message + '</li></ul></div>';
                    wrapper.prepend(html);
                } else {
                    $('.header .basket-btn__counter').text(data.total_products);
                    //update quantities
                    quantity = parseInt(quantity);
                    btn.closest('.input-group').find('[data-mode="minus"]').data('quantity-cart-item', (quantity-1)).attr('data-quantity-cart-item', (quantity-1));
                    btn.closest('.input-group').find('[data-mode="plus"]').data('quantity-cart-item', (quantity+1)).attr('data-quantity-cart-item', (quantity+1));
                    btn.closest('.input-group').find('.quantity-field').val(quantity);
                    if (quantity < 2) {
                        btn.closest('.input-group').find('[data-mode="minus"]').addClass('hidden');
                    } else {
                        btn.closest('.input-group').find('[data-mode="minus"]').removeClass('hidden');
                    }
                    if (quantity == 0) {
                        $('.modal-section-cart-popup').fadeOut();
                    }
                }
            },
            complete: function(){
                wrapper.data("busy", false).removeClass("busy");
            }
        });
    });

    if ($('form.woocommerce-checkout').length) {
        /*$('input#billing_email').inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            placeholder: " ",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    casing: "lower"
                }
            }
        });

        $(".phone-input").inputmask({ mask: "(999) 999-9999", placeholder: " "});*/
    }

    $(document).on('keypress', '[data-range-input]', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
    });
    $(document).on('change', '[data-range-input]', function(e) {
        let obj = $(this);
        let value = parseInt(obj.val());
        let valueInit = parseInt(obj.val());
        let step = parseInt(obj.attr('step'));
        let min = parseInt(obj.attr('min'));
        let max = parseInt(obj.attr('max'));
        if (value < min) {
            value = min;
        }
        if (value > max) {
            value = max;
        }
        if ((value % step) !== 0) {
            value = Math.round(value / step) * step;
        }
        if (valueInit != value) {
            obj.val(value);
        }

        var widthrange = $('.widthrangeinput').val();
        var heighthrange = $('.heightrangeinput').val();
        if ($('[data-product_attribute="width"]').length && widthrange && heighthrange) {
            $('[data-product_attribute="width"]').val(widthrange).trigger('change');
            $('[data-product_attribute="height"]').val(heighthrange).trigger('change');
        }
    });
});

function recalculatePrice() {
    let frm = $('#product_form');
    let product_id = frm.find('[name="product_id"]').val();
    let wrapper = frm;

    if (wrapper.data("busy")) return;
    wrapper.data("busy", true).addClass("busy");

    let data = frm.serialize();
    data = data ? data + '&action=recalculate_price' : 'action=recalculate_price';
    $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: "post",
        dataType: "json",
        data: data,
        beforeSend: function() {
            if ($('.post-'+product_id).length) {
                priceClass = '.post-'+product_id+' .price';
            } else {
                priceClass = '.postid-'+product_id+' .price';
            }
            priceClass2 = '.single-product .popup-price';
            if ($('.post-'+product_id).length) {
                titleClass = '.post-'+product_id+' .page-linetitle';
            } else {
                titleClass = '.postid-'+product_id+' .page-linetitle';
            }
            imageClass = '.product-topsect__pic>div';
            varImagesClass = '.product-topsect__pic .var_images';
            $(priceClass).append('<span class="loader"></span>');
            $(priceClass2).append('<span class="loader"></span>');
        },
        success: function(data) {
            //frm.find('[name="product_id"]').val(data.product_id);
            wrapper.find('.error').remove();
            if (data.has_error) {
                $(titleClass).after('<div class="error">' + data.error_message + '</div>');
                frm.find('[data-add-to-cart]').hide();
            } else {
                frm.find('[data-add-to-cart]').show();
                $(priceClass).html(data.price);
                $(priceClass2).html(data.price);
                $(titleClass).html(data.title);
                if (data.image) {
                    $(imageClass).html(data.image);
                    zoomImage();
                }
                $(varImagesClass).hide();
                if (data.product_images && data.product_images.length) {
                    let imagesHtml = '';
                    $.each( data.product_images, function ( key, image ) {
                        imagesHtml += '<div><a href="' + image.large + '" target="_blank" class="thumbnail"><img src="' + image.thumb + '" alt=""></a></div>';
                    });
                    if (imagesHtml){
                        $(varImagesClass).html(imagesHtml).show();
                        $(varImagesClass).slickLightbox();
                    }
                }
                let oneClickBuySelector = '.single_add_to_cart_button';
                if ($(oneClickBuySelector).length) {
                    $(oneClickBuySelector).attr('data-variation_id', data.variant_id).data('variation_id', data.variant_id);
                }
            }
        },
        complete: function(){
            wrapper.data("busy", false).removeClass("busy");
            $(wrapper).find('.loader').remove();
        }
    });
}

function zoomImage(){
    $('.product-topsect__pic .prmainpic img').lightzoom({
        glassSize: 200,
        zoomPower: 8
    });
}

/*checkout custom fields for ukrposhta*/
$(document).ready(function () {
    if ($('body').hasClass('woocommerce-checkout')){
        let isUkrPoshtaShippingSelected = function(){
            let currentShipping = $('.shipping_method').length > 1 ?
                $('.shipping_method:checked').val() :
                $('.shipping_method').val();
            return currentShipping && currentShipping.match(/^u_poshta_shipping_method/i);
        };

        let selectShipping = function(){
            if(isUkrPoshtaShippingSelected()){
                $('#ukrposhta_shipping_fields').css('display', 'block');
                $('.woocommerce-shipping-fields').css('display', 'none');
            }else{
                $('#ukrposhta_shipping_fields').css('display', 'none');
                $('.woocommerce-shipping-fields').css('display', 'block');
            }
        };

        $(document).on('change', '[name*="shipping_method"]', function(e){
            selectShipping();
        });

        $('#ukrposhta_shipping_fields').css('display', 'none');
        selectShipping();
    }

    $('.filter-switcher').click(function () {
        $(this).toggleClass('rotatearrow');
        $(this).next('.filter').slideToggle();
    });

    zoomImage();

    $('li.woocommerce-MyAccount-navigation-link.is-active').addClass('active');
    $('.socials-list').addClass('signforms__btnsbox');
    $('.ywsl-social.ywsl-google').addClass('google-btn');
    $('.ywsl-social.ywsl-facebook').addClass('facebook-btn');

    $('.google-btn').append('<span>google</span>');
    $('.facebook-btn').append('<span>facebook</span>');

    $('.google-btn > img').attr("src", "/wp-content/themes/rollo/assets/image/icon/google-plus.svg");
    $('.facebook-btn > img').attr("src", "/wp-content/themes/rollo/assets/image/icon/fb.svg");

    if ($('body.logged-in').length) {
        $('body.logged-in header').addClass('login');
    }


    if($('.home-slider [data-bg]').length){
        $('.home-slider [data-bg]').each(function(key, item){
            var bg = $(item).data('bg');
            if(bg){
                $(item).css('background-image', 'url("' + bg + '")');
            }
            $(item).removeAttr('data-bg');
        });
    }
});


// home slider
if ($('.home-slider').length){
    $('.home-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        nextArrow: '<button type="button" class="slick-next">' + home_slider_next_btn_text + '</button>',
        prevArrow: false,
        dots: true,
        lazyLoad: 'ondemand',
    });
}
// home slider - END
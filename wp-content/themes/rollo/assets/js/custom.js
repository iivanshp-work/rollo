$(document).ready(function () {
    $(document).on('click', '[data-pa-type]', function(e){
        let type = $(this).data('pa-type');
        let id = $(this).data('id');
        $(this).parent().parent().find('.active').removeClass('active');
        $(this).addClass('active');
        $('[data-product_attribute="' + type + '"]').val(id).trigger('change');
    });

    $(document).on('change', '[data-product-color-popup]', function(e){
        $('[data-product_attribute="pa_kolory-modeli"]').val($(this).val()).trigger('change');
    });

    $(document).on('click', '[data-product-standard-sizes]', function(e){
        let width = $(this).data('width');
        let height = $(this).data('height');
        $('.newswidth text').html(width);
        $('.newsheight text').html(height);
        $('.sizelist').addClass('littheight');
        $(".settblock.new-size, .sizelist__boxnew .sizelist__row").show();
        $('[data-product_attribute="width"]').val(width).trigger('change');
        $('[data-product_attribute="height"]').val(height).trigger('change');
    });

    $(document).on('click', '#product_form .delete-size', function(e){
        $('[data-product_attribute="width"]').val('0').trigger('change');
        $('[data-product_attribute="height"]').val('0').trigger('change');
    });

    $(document).on('change', '[data-product_attribute].recalculate_price', function(e){
        recalculatePrice();
    });

    $(document).on('submit', '#product-review-form', function(e){
        e.preventDefault();
        let frm = $('#product-review-form');
        let wrapper = frm;

        //if (wrapper.data("busy")) return;
        wrapper.data("busy", true);
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
                wrapper.data("busy", false);
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

        //if (wrapper.data("busy")) return;
        wrapper.data("busy", true);

        let data = frm.serialize();
        data = data ? data + '&action=ajax_add_to_cart' : 'action=ajax_add_to_cart';
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function() {
                btn.attr('disabled', 'disabled');
            },
            success: function(data) {
                wrapper.find('.error').remove();
                if (data.has_error) {
                    $(titleClass).after('<div class="error">' + data.error_message + '</div>');
                } else {
                    //redirect to checkout;
                }
            },
            complete: function(){
                wrapper.data("busy", false);
                btn.removeAttr('disabled');
                $(wrapper).find('.loader').remove();
            }
        });
    });
});

function recalculatePrice() {
    let frm = $('#product_form');
    let product_id = frm.find('[name="product_id"]').val();
    let wrapper = frm;

    //if (wrapper.data("busy")) return;
    wrapper.data("busy", true);

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
            }
        },
        complete: function(){
            wrapper.data("busy", false);
            $(wrapper).find('.loader').remove();
        }
    });
}

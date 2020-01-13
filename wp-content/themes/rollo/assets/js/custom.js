$(document).ready(function () {
    $(document).on('click', '[data-pa-type]', function(e){
        let type = $(this).data('pa-type');
        let id = $(this).data('id');
        $(this).parent().parent().find('.active').removeClass('active');
        $(this).addClass('active');
        $('[data-product_attribute="' + type + '"]').val(id).trigger('change');
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
                if ($('.post-'+product_id).length) {
                    titleClass = '.post-'+product_id+' .page-linetitle';
                } else {
                    titleClass = '.postid-'+product_id+' .page-linetitle';
                }
                $(priceClass).html('<span class="loader"></span>');
            },
            success: function(data) {
                //frm.find('[name="product_id"]').val(data.product_id);
                $(priceClass).html(data.price);
                $(titleClass).html(data.title);
            },
            complete: function(){
                wrapper.data("busy", false);
                $(wrapper).find('.loader').remove();
                console.log('complete');
            }
        });
        console.log('end');
    }
});

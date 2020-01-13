$(document).ready(function () {
    $(document).on('click', '[data-pa-type]', function(e){
        let type = $(this).data('pa-type');
        let id = $(this).data('id');
        $(this).parent().parent().find('.active').removeClass('active');
        $(this).addClass('active');
        console.log(type, id);
        $('[data-product_attribute="' + type + '"]').val(id).trigger('change');

    });

    $(document).on('change', '[data-product_attribute].recalculate_price', function(e){
        recalculatePrice();
    });



    function recalculatePrice() {
        let frm = $('#product_form');
        let product_id = frm.find('[name="product_id"]').val();
        let wrapper = frm;

        if (wrapper.data("busy")) return;
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
                console.log(priceClass);
                $(priceClass).html('<span class="loader"></span>');
            },
            success: function(data) {
                console.log('suucess');
                //$(priceClass).html(data.price);
            },
            complete: function(){
                /*wrapper.data("busy", false);
                $(wrapper).find('.loader').remove();*/
                console.log('complete');
            }
        });
        console.log('end');
    }
});
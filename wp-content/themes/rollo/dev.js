jQuery(function(){

    //breadcrumbs
    jQuery('.breadcrumbs_breadcrumbs > div:first-child span').text('');
    jQuery('.breadcrumbs_breadcrumbs > div:first-child a').attr('href', '/mahazyn');
    //---------breadcrumbs

    jQuery(':contains("Підтвердити замовлення")').closest('button').click();// cart double click hack


    //adress for courier
    jQuery(document).on('keyup','#adress_for_courier',function() {
        jQuery('#address_1_field').val(jQuery('#adress_for_courier').val());
    });

    jQuery('.vm-cart-item-quantity input').change(function(){
        jQuery('.vm2-add_quantity_cart').click();
    });// auto update cart quantity

   jQuery('.product-field-display input[type="radio"]:first-child').prop("checked", true); // check firts product size as default

    jQuery('.custom_button').click(function(){
        jQuery('.moduletable_main_menu').slideToggle('slow');
        jQuery(this).toggleClass('opened');
    });// mob menu button


    jQuery('.moduletable_top_cat_text').click(function(){
        jQuery('.moduletable_category_menu').slideToggle('slow');
    });// mob category shop menu button

    //price txt
    var slovo = jQuery('.productdetails-view h1').text();
    if( slovo.indexOf('Ролети') !== -1 ){
        jQuery('.price_txt').text('Ціна за ролету:');
    }else if( slovo.indexOf('Жалюзі') !== -1 ){
        jQuery('.price_txt').text('Ціна за жалюзі:');
    }

    //-----------*** NEW CALCULATOR ***-------//
    var priceForMM = jQuery('#price_for_mm').text();// price for SM
    var additionalLengthPrice = 0;//set additional Length Price DEFAULT

    //insert button into VM (UA/RU)
    var custom = jQuery('.product-description div').hasClass('custom_product');
    var sendCustomPrice = jQuery('.product-field').hasClass('product-field-type-E');
    var korob = jQuery('.custom_product').hasClass('korob');
    var dealer = jQuery('.custom_product').hasClass('dealer');
    var kamilaLuminis = jQuery('.custom_product').hasClass('kamila_luminis');
    var lon = jQuery('.custom_product').hasClass('lon');
    var dN = jQuery('.custom_product').hasClass('d_n');
    var vertical = jQuery('.custom_product').hasClass('vertical');
    var lonK = jQuery('.custom_product').hasClass('lon_k');
    var plise = jQuery('.custom_product').hasClass('plise');

    jQuery('.vmcustom-textinput[size="100"]').attr('disabled',true);//disable for standard sizes
    jQuery('.vmcustom-textinput[size="1"]').attr('disabled',true);//disable for standard sizes

    jQuery('.custom_product').clone().prependTo('.vm-product-details-container .addtocart-bar');// move controls into 'add to cart' bar


    if(custom && sendCustomPrice && !korob && !dealer && !plise){
        jQuery('html[lang="uk-ua"] .vm-product-details-container .addtocart-bar').prepend('<div class="custom_product_button">Замовити інший розмір</div>');// open form buttonfor ua
        jQuery('html[lang="uk-ua"] .vm-product-details-container .addtocart-bar').prepend('<div class="custom_product_reload" style="display:none;">Повернутись до стандартних розмірів</div>');// reload button for ua
    }else if(custom && sendCustomPrice && korob || dealer || plise){
        jQuery('.vmcustom-textinput[size="100"]').attr('disabled',false);
        jQuery('.vmcustom-textinput[size="1"]').attr('disabled',false);
        jQuery('.product-field-type-S').css('opacity','0.5');
        jQuery('.product-field-type-S input').attr('disabled','disabled');
        jQuery('.addtocart-bar .custom_product').slideDown();
        jQuery('.vmcustom-textinput[size="1"]').keyup();
        jQuery('html[lang="uk-ua"] .addtocart-button').append('<div class="custom_calc_button">Розрахувати</div>');
    }


    jQuery('.custom_product_button').click(function(){
        jQuery('.vmcustom-textinput[size="100"]').attr('disabled',false);
        jQuery('.vmcustom-textinput[size="1"]').attr('disabled',false);
        jQuery('.product-field-type-S').css('opacity','0.5');
        jQuery('.product-field-type-S input').attr('disabled','disabled');
        jQuery('.addtocart-bar .custom_product').slideDown();
        jQuery('.vmcustom-textinput[size="1"]').keyup();
        jQuery('.custom_product_button').hide();
        jQuery('.custom_product_reload').show();
        jQuery('html[lang="uk-ua"] .addtocart-button').append('<div class="custom_calc_button">Розрахувати</div>');
    });

    jQuery('.custom_product_reload').click(function(){
        location.reload();
    });

    var fixedPrice = jQuery('.PricesalesPrice').text();
    var numericFixedPrice = parseInt(fixedPrice);

    //show range when move it
    jQuery('#custom_width').on('input',function(){
        jQuery('#for_custom_width input').val(jQuery('#custom_width').val());
    });
    jQuery('#custom_height').on('input',function(){
        jQuery('#for_custom_height input').val(jQuery('#custom_height').val());
    });
    //-------show range when move it

    // only white or brown color for 25/32 system
    if(dealer){

        var colorCheck = 1;
        jQuery('input[type="radio"]').each(function() {
           jQuery(this).attr('number',colorCheck);
           colorCheck++;
        });

        jQuery('select').change(function() {
            var system = jQuery('select option:selected').text();
           // console.log( system );

            if(system.trim()  === 'Механізм 25' || system.trim()  === 'Механізм 32'){
                jQuery('input[number="3"], input[number="4"]').attr('disabled','disabled');
                jQuery('input[number="3"] + label, input[number="4"] + label').css('opacity','0.5');

                if( jQuery('input[number="3"]').is(':checked') ||  jQuery('input[number="4"]').is(':checked') ){
                    jQuery('input[number="1"]').attr('checked', 'checked');
                }

            }else{
                jQuery('input[number="3"], input[number="4"]').attr('disabled',false);
                jQuery('input[number="3"] + label, input[number="4"] + label').css('opacity','1');
            }

        }).change();

    }
    //----------------- only white or brown color for 25/32 system


    //calc price
    function calcPrice(){
        var width =  jQuery('#custom_width').val();// take range width
        jQuery('#for_custom_width input').val(width);//set numeric width

        jQuery('#for_custom_width input').on('change',function(){
            var widthMin = jQuery('#for_custom_width input').attr('min');
            var widthMax = jQuery('#for_custom_width input').attr('max');
            var wMin = parseInt(widthMin);
            var wMax = parseInt(widthMax);

            var width2 =  jQuery('#for_custom_width input').val();//teke numeric width
            if(width2 < wMin){
                jQuery('#for_custom_width input').val(wMin);
            }else if(width2 > wMax){
                jQuery('#for_custom_width input').val(wMax);
            }

            jQuery('#custom_width').val(width2);//set range width

            jQuery('#custom_width').trigger('change');//send price

        });

        var height =  jQuery('#custom_height').val();// take range height
        jQuery('#for_custom_height input').val(height);//show numeric height

        jQuery('#for_custom_height input').on('change',function(){
            var heightMin = jQuery('#for_custom_height input').attr('min');
            var heightMax = jQuery('#for_custom_height input').attr('max');
            var hMin = parseInt(heightMin);
            var hMax = parseInt(heightMax);

            var height2 =  jQuery('#for_custom_height input').val();//teke numeric height
            if(height2 < hMin){
                jQuery('#for_custom_height input').val(hMin);
            }else if(height2 > hMax){
                jQuery('#for_custom_height input').val(hMax);
            }

            jQuery('#custom_height').val(height2);//set range height

            jQuery('#custom_height').trigger('change');//send price
        });

        if( (kamilaLuminis || lon ) && width < 500 ){//set min price for width
            width = 500;
        }else if( dN && (width < 500) ){
            width = 500;//"DEN-NICH" set min price for width
        }/*else if( vertical && height < 1600 ){
            height2 = 1600;//"VERICAL" set min price for height
        }*/else if( (lonK) && width < 500 ){
            width = 500;//"KOROB" min width
        }/*else if( plise && ((width * height /1000) < 700 ) ){
            width = 1000;//"plise" min 0.7_M2
            height2 = 700;
        }*/

        var tkanPrice = (priceForMM * width) + 45; //calc primary price

        if(kamilaLuminis && !dealer){

            //"KAMILA-LUMINIS" only 1 side can be over 195sm
            if(height > 1950){
                jQuery('#custom_width, #for_custom_width input').attr( 'max', '1950');
            }else{
                jQuery('#custom_width, #for_custom_width input').attr( 'max', '2800');
            }
            if(width > 1950){
                jQuery('#custom_height, #for_custom_height input').attr( 'max', '1950');
            }else{
                jQuery('#custom_height, #for_custom_height input').attr( 'max', '2800');
            }

            //if width more then ***
            if(width >= 1250 && width < 1800){
                tkanPrice = (priceForMM * width) + 115;
            }else if(width >= 1800){
                tkanPrice = (priceForMM * width) + 280;
            }else{
                tkanPrice = (priceForMM * width) + 45;
            }

            //"KAMILA-LUMINIS" calc additional height Price
            if(height>1950 && height<2300){
                additionalLengthPrice = tkanPrice * 0.4;
            }else if(height>=2300 && height<2500){
                additionalLengthPrice = tkanPrice * 0.6;
            }else if(height >= 2500){
                additionalLengthPrice = tkanPrice * 0.8;
            }else{
                additionalLengthPrice = 0;
            }

        }else if(kamilaLuminis && dealer){

            //"KAMILA-LUMINIS" only 1 side can be over 195sm
            if(height > 1950){
                jQuery('#custom_width, #for_custom_width input').attr( 'max', '1950');
            }else{
                jQuery('#custom_width, #for_custom_width input').attr( 'max', '2800');
            }
            if(width > 1950){
                jQuery('#custom_height, #for_custom_height input').attr( 'max', '1950');
            }else{
                jQuery('#custom_height, #for_custom_height input').attr( 'max', '2800');
            }

            tkanPrice = priceForMM * width;

            //"DEALER" calc additional height Price
            if(height>1700 && height<2300){
                additionalLengthPrice = tkanPrice * 0.4;
            }else if(height>=2300 && height<2500){
                additionalLengthPrice = tkanPrice * 0.6;
            }else if(height >= 2500){
                additionalLengthPrice = tkanPrice * 0.8;
            }else{
                additionalLengthPrice = 0;
            }

        }else if(lon && !dealer){

            //"LON" only 1 side can be over 175sm
            if(height > 1750){
                jQuery('#custom_width, #for_custom_width input').attr( 'max', '1750');
            }else{
                jQuery('#custom_width, #for_custom_width input').attr( 'max', '2800');
            }
            if(width > 1750){
                jQuery('#custom_height, #for_custom_height input').attr( 'max', '1750');
            }else{
                jQuery('#custom_height, #for_custom_height input').attr( 'max', '2800');
            }

            //if width more then ***
            if(width >= 1250 && width < 1800){
                tkanPrice = (priceForMM * width) + 115;
            }else if(width >= 1800){
                tkanPrice = (priceForMM * width) + 280;
            }else{
                tkanPrice = (priceForMM * width) + 45;
            }

            //"LON" calc additional Height Price
            if(height>1650 && height<2300){
                additionalLengthPrice = tkanPrice * 0.4;
            }else if(height>=2300 && height<2500){
                additionalLengthPrice = tkanPrice * 0.6;
            }else if(height >= 2500){
                additionalLengthPrice = tkanPrice * 0.8;
            }else{
                additionalLengthPrice = 0;
            }

        }else if(lon && dealer){

            //"LON" only 1 side can be over 175sm
            if(height > 1750){
                jQuery('#custom_width, #for_custom_width input').attr( 'max', '1750');
            }else{
                jQuery('#custom_width, #for_custom_width input').attr( 'max', '2800');
            }
            if(width > 1750){
                jQuery('#custom_height, #for_custom_height input').attr( 'max', '1750');
            }else{
                jQuery('#custom_height, #for_custom_height input').attr( 'max', '2800');
            }

            tkanPrice = priceForMM * width;

            //"DEALER" calc additional height Price
            if(height>1700 && height<2300){
                additionalLengthPrice = tkanPrice * 0.4;
            }else if(height>=2300 && height<2500){
                additionalLengthPrice = tkanPrice * 0.6;
            }else if(height >= 2500){
                additionalLengthPrice = tkanPrice * 0.8;
            }else{
                additionalLengthPrice = 0;
            }

        }else if( dN && !dealer ){//dn

            //if width more then ***
            if(width >= 1250 && width < 1800){
                tkanPrice = (priceForMM * (height * width / 1000) ) + 115;
            }else if(width >= 1800){
                tkanPrice = (priceForMM * (height * width / 1000) ) + 280;
            }else{
                tkanPrice = (priceForMM * (height * width / 1000));
            }

        }else if(dN && dealer){//dn dealer

            tkanPrice = (priceForMM * (height * width / 1000)); //calc primary price

        }else if(vertical){

            if( height < 1600 ){
                tkanPrice = (priceForMM * (1600 * width / 1000) ); //"VERTICAL" calc primary price
            }else{
                tkanPrice = (priceForMM * (height * width / 1000) ); //"VERTICAL" calc primary price
            }

        }else if(lonK && !dealer){

            if(height>1650 && height<2300){
                additionalLengthPrice = tkanPrice * 0.4;
            }else if(height>=2300 && height<2500){
                additionalLengthPrice = tkanPrice * 0.6;
            }else if(height>=2500 && height<2800){
                additionalLengthPrice = tkanPrice * 0.8;
            }else if(height >= 2800){
                additionalLengthPrice = tkanPrice * 1;
            }else{
                additionalLengthPrice = 0;
            }

            var korobPrice;
            if(getColor === '1color_white'){
                korobPrice = 0.62;
            }else if(getColor === '1color_brown'){
                korobPrice = 0.62;
            }
            //console.log(korobPrice);
            tkanPrice = (korobPrice * width) + (priceForMM * width) + 82;

        }else if(lonK && dealer){

            if(height>1700 && height<2300){
                additionalLengthPrice = tkanPrice * 0.4;
            }else if(height>=2300 && height<2500){
                additionalLengthPrice = tkanPrice * 0.6;
            }else if(height >= 2500){
                additionalLengthPrice = tkanPrice * 0.8;
            }else{
                additionalLengthPrice = 0;
            }

            var korobPrice;
            if(getColor === '1color_white'){
                korobPrice = 0.352;
            }else if(getColor === '1color_brown'){
                korobPrice = 0.402;
            }else if(getColor === '1color_golden_oak'){
                korobPrice = 0.605;
            }
            //console.log(korobPrice);
            tkanPrice = (korobPrice * width) + (priceForMM * width) + 82;

}else if( plise ){//plise

            var area = (width / 1000) * (height / 1000);
            if (area < 0.5) {
                area = 0.5;
            }
            var width1 = width;
            if (width < 500) {
                width1 = 500;
            }
            tkanPrice = (priceForMM * area * 1000) + ((width1 * 0.359) + 179);
            
            /*if( plise && ((width * height /1000) < 500 ) ){
                tkanPrice = (priceForMM * (500 * 1000 / 1000)) + ((width * 0.359) + 179);
            }else{
                tkanPrice = (priceForMM * (height * width / 1000)) + ((width * 0.359) + 179);
            }*/

        }

        var finalPrice = (tkanPrice + additionalLengthPrice) - numericFixedPrice;//calc final price

        jQuery('.vmcustom-textinput[size="1"]').val(Math.ceil(finalPrice));//show 'rounded to top' price

        jQuery('.vmcustom-textinput[size="1"]').keyup();// send price from 'price' to product price

        var widthForCart = jQuery('#custom_width').val();//take width for cart

        jQuery('.vmcustom-textinput[size="100"]').val('('+widthForCart+'x'+height+')');//custom size

    };

    //get color for korob
    var getColor;
    function getKorob(){
        getColor = jQuery('.product-field-type-M input:checked + label img').attr('alt');
        //console.log(getColor);
    };
    getKorob();
    jQuery('.product-field-type-M input').change(function(){
        getKorob();
        calcPrice();
    });
    //-----------------------get color for korob

    //run calc
    jQuery('.custom_product input[type="range"]').on('change',function(){
        calcPrice();
    });
    calcPrice();

    //.vmcustom-textinput[size="100"] --- Спеціальний Розмір (X Y)
    //.vmcustom-textinput[size="1"] --- Спеціальна ціна
    //---------------*** END OF  NEW CALCULATOR ***------------//



    //нова пошта
    // міста Нової Пошти
        var params = {
            "apiKey": "95bfa2a74c7767b8a85d89e26a952ca4",
            "modelName": "Address",
            "calledMethod": "getCities"
        };

        jQuery.ajax({
            url: 'https://api.novaposhta.ua/v2.0/json/?' + jQuery.param(params),
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/json");
            },
            type: 'POST',
            dataType: 'jsonp',
            data: '{body}'
        }).done(function(response) {
            var city = [];
            for(var i = 0; i < response.data.length; i++){
               city[i] = response.data[i].Description;
            }
            jQuery('#city_field').autocomplete({
                source: city,
                minLength: 3
            });
        }).fail(function() {

        });
    //--------------------міста Нової Пошти

    // відділення Нової Пошти
    var getCity;
    jQuery('#city_field').change(function(){
        getCity = jQuery(this).val();
        jQuery('#fax_field').val('');
    });

    jQuery('#fax_field').focus( function() {

        var params = {
            "apiKey": "95bfa2a74c7767b8a85d89e26a952ca4",
            "modelName": "AddressGeneral",
            "calledMethod": "getWarehouses",
            "methodProperties": {
                "CityName": getCity
            }
        };

        jQuery.ajax({
            url: 'https://api.novaposhta.ua/v2.0/json/?' + jQuery.param(params),
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/json");
            },
            type: 'POST',
            dataType: 'jsonp',
            data: '{body}'
        }).done(function(response2) {
            var vidd = [];
            for(var i = 0; i < response2.data.length; i++){
               vidd[i] = response2.data[i].Description;
            }
            jQuery('#fax_field').autocomplete({
                source: vidd,
                minLength: 0
            });
            jQuery('#fax_field').autocomplete('search', '');
        }).fail(function() {

        });

    });
    //--------------------відділення Нової Пошти
    //-----------нова пошта

    //slick
    var windowWidth = jQuery(window).width();
    if(windowWidth > 400 && windowWidth < 800){
        jQuery('.vmproduct_slick').slick({
            autoplay: true,
            slidesToShow: 3,
            slidesToScroll: 1
        });
    }else if(windowWidth < 400){
        jQuery('.vmproduct_slick').slick({
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1
        });


        var isShop = location.href;
        if( isShop === 'https://www.rollo.lviv.ua/mahazyn'){
            jQuery('.moduletable_category_menu').css('display','block');
        }
        //console.log(isShop);

    }else{
        jQuery('.vmproduct_slick').slick({
            autoplay: true,
            slidesToShow: 4,
            slidesToScroll: 1
        });
    }
    //--------------slick


});
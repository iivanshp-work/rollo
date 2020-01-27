$(document).ready(function () {

    // home slider
    $('.home-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        nextArrow: '<button type="button" class="slick-next">наступний</button>',
        prevArrow: false,
        dots: true,
    });
    // home slider - END

    // burger menu
    $('.burger').click(function () {
        $(this).toggleClass('active');
        $('header.header .col-xl-6.col-lg-5').toggle();
        $('.submenu').hide();
        $('.header__menu>ul li span').removeClass('actaft');
    });

    if ($(window).width() < 992) {
        $('.header__menu>ul li span').click(function () {
            $('header.header .submenu').not($(this).next()).hide();
            $(this).next().toggle();
            $('.header__menu>ul li span').not($(this)).removeClass('actaft');
            $(this).toggleClass('actaft');
        });
    }
    // burger menu -END

    // menu category pic
    $('.header__menu>ul .submenu.megamenu ul li a[data-imghov]').mouseover(function () {
        var newHover = $(this).attr('data-imghov');
        var textHover = $(this).attr('data-texthov');
        $('.header__categorypic img').attr('src', newHover);
        $('.header__categorypic p').html(textHover);
    })
    // menu category pic - END

    // input slyled
    $(function () {
        $('select, .filter__lists.radiostyled input[type="radio"], .check-formfield input').styler();
    });
    // input slyled - END

    // Catalog filter
    $('.filter__title').click(function () {
        $(this).toggleClass('rotatearrow');
        $(this).next('.filter__lists').slideToggle();
    });
    // Catalog filter end

    // input mask
    if ($('*').is('.form-section')) {
        $('.email-input').inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
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

        $(".phone-input").inputmask({ "mask": "(999) 999-9999" });
    }
    // input mask END

    // num products + or -
    // plus minus
    function incrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal)) {
            parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(0);
        }
    }

    function decrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal) && currentVal > 0) {
            parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(0);
        }
    }

    $('.input-group').on('click', '.button-plus', function (e) {
        incrementValue(e);
    });

    $('.input-group').on('click', '.button-minus', function (e) {
        decrementValue(e);
    });

    // num products END

    // remove row - buy page
    $('.incard__remove').click(function () {
        $(this).parents('.incard__row').fadeOut();

    });
    // remove row - buy page - END

    // accordeon
    $('.measure__acctitle').click(function () {
        $(this).next().slideToggle();
        $('.measure__accdescription').not($(this).next()).slideUp();

        $('.measure__accblock').not($(this).parent()).removeClass('shadow');
        $(this).parent('.measure__accblock').toggleClass('shadow');
    });
    // accordeon - END
    // USER form
    $('.user-form__field .edit-btn').click(function () {
        $(this).next().prop('disabled', false);
        $(this).parent().addClass('active-inpf');
        $(this).hide();
    });

    // parallax
    if ($('*').is('#scene')) {
        $("#scene").parallax();
    }

    // login
    $('.signforms .registration').click(function () {
        $('.logintab').hide();
        $('.regtab').show();
    });
    $('.forgotpass-text').click(function () {
        $('.logintab').hide();
        $('.forgotpasstab').show();
    });
    $('.signforms__btnsbox .back').click(function () {
        $('.forgotpasstab, .regtab').hide();
        $('.logintab').show();
    });
    var countProducts = parseInt($('.prodslider').data('count-products'));
    if (countProducts > 8) countProducts = 8;
    // product slider
    $('.prodslider').slick({
        slidesToShow: countProducts,
        slidesToScroll: 1,
        nextArrow: '<button type="button" class="slick-next"></button>',
        prevArrow: '<button type="button" class="slick-prev"></button>',
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]

    });
    // more reviews
    $('.review-more').click(function () {
        $('.more-reviewssect').slideToggle();
        $(this).toggleClass('rotatearrow');
    });

    // colors slider
    $('.colors-slider').slick({
        slidesToShow: 9,
        slidesToScroll: 1,
        nextArrow: '<button type="button" class="slick-next"></button>',
        prevArrow: '<button type="button" class="slick-prev"></button>',
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 1541,
                settings: {
                    slidesToShow: 8,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 7,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 361,
                settings: {
                    slidesToShow: 4,
                }
            }
        ]
    });

    // products btns
    $('.left-right span').click(function () {
        $('.left-right span').removeClass('active');
        $(this).addClass('active');
    });
    $('.systems-color > div').click(function () {
        $('.systems-color > div').removeClass('active');
        $(this).addClass('active');
    });
    $('.sizelist__row').click(function () {
        $('.sizelist__row').not($(this)).removeClass('active');
        $(this).addClass('active');
    });

    // modal
    $('.prwhitebtn').click(function () {
        $('.modal-section').fadeIn();
    });

    $('.modal-cancel').click(function () {
        $(this).parents('.modal-section').fadeOut();
    });

    $('.modal-section').click(function (event) {
        if (!$(event.target).closest(".modal-sizeset").length) {
            $('.modal-section').fadeOut();
        }
    });

    $('.modalbtn').click(function () {
        $('.modal-section').fadeOut();
        $(".settblock.new-size").show();
    });




    $('.delete-size').click(function () {
        $(this).parent().hide();
        $('.sizelist').removeClass('littheight');
        $(".settblock.new-size").hide();
        // if ($(".sizelist__boxnew .sizelist__row").length == 0) {
        //     $(".settblock.new-size").hide();
        // }
    });


    $('.modalbtn').click(function () {
        var widthrange = $('.widthrange').html();
        var heighthrange = $('.heighthrange').html();
        console.log(widthrange);
        console.log(heighthrange);

        $('.newswidth text').html(widthrange);
        $('.newsheight text').html(heighthrange);

        /* CHANGES RELATED TO WC PRODUCTS added if below */
        if ($('[data-product_attribute="width"]').length) {
            $('[data-product_attribute="width"]').val(widthrange).trigger('change');
            $('[data-product_attribute="height"]').val(heighthrange).trigger('change');
        }

        /* CHANGES RELATED TO WC PRODUCTS added if below */
        //$('.sizelist').addClass('littheight');
        $(".settblock.new-size, .sizelist__boxnew .sizelist__row").show();
    });

    // header search
    $('.header__search img').click(function () {
        $(this).next().fadeToggle();
    });
});




// MAP
if ($('*').is('#map')) {

    function initMap() {
        if ($(window).width() < 768) {
            var latc1 = 49.8113999;
            var lngc1 = 23.9748614;
        } else {
            var latc1 = 49.8113999;
            var lngc1 = 23.9778614;
        }
        let lat1 = 49.811954, lng1 = 23.9751068;
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: latc1, lng: lngc1
            }
            // center: {
            //     lat: 49.8113999, lng: 23.9778614
            // }
            , zoom: 17, mapTypeId: "roadmap", panControl: !1, zoomControl: !1, scaleControl: !1, disableDefaultUI: !0, styles: [

            ],
            // zoomControl: true,
            // mapTypeControl: true,
            // scaleControl: true,
            // streetViewControl: true,
            // rotateControl: true,
            // fullscreenControl: true
        }
        );

        var features = [
            {
                position: new google.maps.LatLng(lat1, lng1),
                type: 'info'
            }
        ];

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat1, lng1),
            map: map,
            icon: {
                url: "image/icon/pin.svg",
                scaledSize: new google.maps.Size(40, 40) // pixels
            }
        });
    }
}
// MAP END



if ($('*').is('.modal-sizeset')) {
    $(function () {

        var $document = $(document);
        var selector = '[data-rangeslider]';
        var $element = $(selector);

        // For ie8 support
        var textContent = ('textContent' in document) ? 'textContent' : 'innerText';

        // Example functionality to demonstrate a value feedback
        function valueOutput(element) {
            var value = element.value;
            var output = element.parentNode.getElementsByTagName('output')[0] || element.parentNode.parentNode.getElementsByTagName('output')[0];
            output[textContent] = value;
        }

        $document.on('input', 'input[type="range"], ' + selector, function (e) {
            valueOutput(e.target);
        });


        // Basic rangeslider initialization
        $element.rangeslider({

            // Deactivate the feature detection
            polyfill: false,

            // Callback function
            onInit: function () {
                valueOutput(this.$element[0]);
            },

            // Callback function
            onSlide: function (position, value) {
                // console.log('onSlide');
                // console.log('position: ' + position, 'value: ' + value);
            },

            // Callback function
            onSlideEnd: function (position, value) {
                /* CHANGES RELATED TO WC PRODUCTS */
                var widthrange = $('.widthrange').html();
                var heighthrange = $('.heighthrange').html();
                if ($('[data-product_attribute="width"]').length) {
                    $('[data-product_attribute="width"]').val(widthrange).trigger('change');
                    $('[data-product_attribute="height"]').val(heighthrange).trigger('change');
                }
                // console.log('position: ' + position, 'value: ' + value);
            }
        });

    });
}

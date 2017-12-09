$(function () {
    // Cancelled transactions
    $.post( "listb?id="+$('#countryId').val(), function( data ) {
      $( "#accountclient-bankid" ).html( data );
    });

    $('#form-calculator-client').on('submit', function (e) {
        e.preventDefault();
        var url = $(this).attr('url');
        var amount = $('#amount').val();
        var currencyIdFrom = $('#currencyIdFrom').val();
        var currencyIdTo = $('#currencyIdTo').val();

        $.ajax({
            url: url,
            type: 'post',
            data: {
                amount: amount,
                currencyIdFrom: currencyIdFrom,
                currencyIdTo: currencyIdTo,
                _csrf: yii.getCsrfToken()
            },
            success: function (data) {

                switch(data){
                    case '1':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Debe introducir una cantidad a convertir');
                        break;
                    case '2':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Las monedas de conversión deben ser diferentes');
                        break;
                    case '3':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Lo sentimos. La cantidad solicitada no se encuentra disponible.');
                        break;
                    case '4':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Lo sentimos. La tasa de cambio solicitada no está disponible. Por favor intente más tarde.');
                        break;
                    case '5':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Lo sentimos. No podemos transferir esa cantidad. Pruebe con un monto mas alto.');
                        break;
                    default:
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === true)
                            $('#btn-continue').removeClass('hidden');
                        $('#result').html(data);
                        break;
                }
            }

        });
    });

    $('#form-calculator-button').on('click', function () {

        var url = $(this).attr('url');
        var amount = $('#amount').val();
        var currencyIdFrom = $('#currencyIdFrom').val();
        var currencyIdTo = $('#currencyIdTo').val();

        $.ajax({
            url: url,
            type: 'post',
            data: {
                amount: amount,
                currencyIdFrom: currencyIdFrom,
                currencyIdTo: currencyIdTo,
                _csrf: yii.getCsrfToken()
            },
            success: function (data) {

                switch(data){
                    case '1':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Debe introducir una cantidad a convertir');
                        break;
                    case '2':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Las monedas de conversión deben ser diferentes');
                        break;
                    case '3':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Lo sentimos. La cantidad solicitada no se encuentra disponible.');
                        break;
                    case '4':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Lo sentimos. La tasa de cambio solicitada no está disponible. Por favor intente más tarde.');
                        break;
                    case '5':
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === false)
                            $('#btn-continue').addClass('hidden');
                        $('#result').html('Lo sentimos. No podemos transferir esa cantidad. Pruebe con un monto mas alto.');
                        break;
                    default:
                        var classHidden = $('#btn-continue').hasClass('hidden');
                        if (classHidden === true)
                            $('#btn-continue').removeClass('hidden');
                        $('#result').html(data);
                        break;
                }
            }

        });
    });

    $("#btn-index").on("click", function() {
        $('html, body').animate({
            scrollTop: $("#index").offset().top
        }, 1000);
    });
    $("#btn-about").on("click", function() {
        $('html, body').animate({
            scrollTop: $("#about").offset().top
        }, 1000);
    });
    $("#btn-contact").on("click", function() {
        $('html, body').animate({
            scrollTop: $("#contact").offset().top
        }, 1000);
    });
    $("#btn-faq").on("click", function() {
        $('html, body').animate({
            scrollTop: $("#faq").offset().top
        }, 1000);
    });
});

jQuery(function($){
    "use strict";
    if($('#superSizedSlider').length){

        $('#superSizedSlider').height($(window).height());

        $.supersized({

            // Functionality
            slideshow               :   1,          // Slideshow on/off
            autoplay                :   1,          // Slideshow starts playing automatically
            start_slide             :   1,          // Start slide (0 is random)
            stop_loop               :   0,          // Pauses slideshow on last slide
            random                  :   0,          // Randomize slide order (Ignores start slide)
            slide_interval          :   4000,      // Length between transitions
            transition              :   1,          // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
            transition_speed        :   1000,       // Speed of transition
            new_window              :   1,          // Image links open in new window/tab
            pause_hover             :   0,          // Pause slideshow on hover
            keyboard_nav            :   1,          // Keyboard navigation on/off
            performance             :   1,          // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
            image_protect           :   1,          // Disables image dragging and right click with Javascript

            // Size & Position
            min_width               :   0,          // Min width allowed (in pixels)
            min_height              :   0,          // Min height allowed (in pixels)
            vertical_center         :   1,          // Vertically center background
            horizontal_center       :   1,          // Horizontally center background
            fit_always              :   0,          // Image will never exceed browser width or height (Ignores min. dimensions)
            fit_portrait            :   1,          // Portrait images will not exceed browser height
            fit_landscape           :   0,          // Landscape images will not exceed browser width

            // Components
            slide_links             :   'blank',    // Individual links for each slide (Options: false, 'num', 'name', 'blank')
            thumb_links             :   0,          // Individual thumb links for each slide
            thumbnail_navigation    :   1,          // Thumbnail navigation
            slides                  :   [           // Slideshow Images
                {image : '../images/step1.jpg'},

                {image : '../images/step2.jpg'},

                {image : '../images/step3.jpg'}
            ],

            // Theme Options
            progress_bar            :   0,          // Timer for each slide
            mouse_scrub             :   0

        });
    }
});
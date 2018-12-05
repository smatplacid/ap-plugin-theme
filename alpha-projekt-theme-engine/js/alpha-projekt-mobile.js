(function ($) {

    $(document).on('ready', function () {



        $('#anwaltsprofil-mobile').slick({
            dots: false,
            arrows: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        $('#branchen_content_bottom').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            swipe: false,
            cssEase: 'linear',
            asNavFor: '#branchen_nav_top'
            // ,adaptiveHeight: true

        });

        $('#branchen_nav_top').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            // slidesPerRow: 1,
            asNavFor: '#branchen_content_bottom',
            dots: false,
            // fade: true,
            // cssEase: 'linear',
            centerMode: true,
            speed: 500,
            // infinite: true,
            focusOnSelect: true,
            variableWidth: true,
            arrows: false
        });

        $('#aktuelles-slider').slick({
            dots: false,
            infinite: true,
            // centerMode: true,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        // Scrollbar single
        $(".anwaltsprofil-popup").mCustomScrollbar({
            autoHideScrollbar: false,
            theme: "dark",
            scrollbarPosition: "inside",
            axis: "y" // vertical and horizontal scrollbar
        });


        //accordeon

        //-> das könnte auch raus -> und ins css
        $('.accordion-wrapper').css({
            'height': '150px',
            'overflow': 'hidden'
        });

        // On swipe event
        // $('#branchen_nav_top').on('swipe', function(event, slick, direction){
        //     console.log(event);
        //     // left
        // });


        $('.more-switcher').on('click', function () {
            if ($(this).parent().hasClass('open')) {
                $(this).parent().find('.accordion-wrapper').css({
                    'height': '150px',
                    'overflow': 'hidden'
                });
                $(this).parent().removeClass('open');
            } else {
                $(this).parent().find('.accordion-wrapper').css({
                    'height': 'auto',
                    'overflow': 'inherit'
                });
                $(this).parent().addClass('open');
            }
        });

        /*
        ohne hard inline css

        $('.more-switcher').on('click', function () {
            if($(this).parent().hasClass('open')){
                $(this).parent().removeClass('open');
            }else{

                $(this).parent().addClass('open');
            }
        })
        */


        $('.anwalt-more').on('click', function () {
            $id = $(this).attr('id').replace('more-id-', '');
            console.log($id);
            $('#anwaltsprofil-popup-wrapper, #anwaltsprofil-popup-' + $id).show();
        });


        $('.close_anwalt').on('click', function(){
            $('#anwaltsprofil-popup-wrapper,.anwaltsprofil-popup').hide();
        });

    });


})(jQuery);
(function ($) {

    $('.projekt-float').on('click', function () {
        id = $(this).attr('id');
            // .replace('branchen-anwaltsprofil-', '');
        $(id).addClass('active-menu');
    });

    // https://stackoverflow.com/questions/9847580/how-to-detect-safari-chrome-ie-firefox-and-opera-browser/9851769
    var isIE = /*@cc_on!@*/false || !!document.documentMode;
    var isEdge = !isIE && !!window.StyleMedia;

    // 3 lines for injection of SVG images
    objectFitImages();
    var mySVGsToInject = document.querySelectorAll('img.inject-me');
    SVGInjector(mySVGsToInject);
    // 3 lines for injection of SVG images

    if ( isEdge == true || isIE == true ) {} else {
        jarallax(document.querySelectorAll('.jarallax'), {
            speed: 0.2,
            disableParallax: /iPad|iPhone|iPod|Android|Explorer|IE/
        });
    }

    $(window).on("load", function () {

        $("#anwaltsprofil").css("visibility", "visible").css("display", "block");

        // Scrollbar alle
        $("#anwaltsprofil").mCustomScrollbar({
            autoHideScrollbar: false,
            theme: "light",
            scrollbarPosition: "outside",
            scrollInertia:'3000',
            mouseWheel:{
                enable: true,
                scrollAmount: '315'
            },
            axis: "y" // vertical and horizontal scrollbar
        });

        // Scrollbar single
        $(".put-single-anwalt-scrollbar-here").mCustomScrollbar({
            autoHideScrollbar: false,
            theme: "dark",
            scrollbarPosition: "inside",
            axis: "y" // vertical and horizontal scrollbar
        });


    });

    $(document).on('ready', function () {
        $('.ra-related.slider').slick({
            dots: false,
            infinite: true,
            // centerMode: true,
            slidesToShow: 5,
            slidesToScroll: 1
        });

        $(".anwaltsprofil-post").on("click", function () {
            var anwaltId = $(this).attr('class').replace('anwaltsprofil-post', '').replace('image-has-name-inside', '').replace('anwaltsprofil-', '').replace(' ', '');
            var anwaltId_ex = anwaltId.replace(' ', '');
            var anwaltTarget = '.anwaltsprofil-popup-id-' + anwaltId_ex + '';
            var out = document.getElementById('mCSB_1_scrollbar_vertical');
            console.log(out);

            $("#anwaltsprofil-popup-wrapper").show();
            // $('.anwaltsprofil-popup').hide();
            $('#mCSB_1_scrollbar_vertical').css("visibility", "hidden");
            $(anwaltTarget).css("display", "block");
//     target = '#anwaltsprofil-popup-' + this.getAttribute('data-id');
//             $(target).show();
        });

    });

    /* =========================================================== */

    // var containerDiv = document.getElementById("anwaltsprofil");
    // if (containerDiv) {
    //     var innerDivs = containerDiv.getElementsByTagName("DIV");
    //     var AnwaltIds = [];
    //     for (var i = 0; i < innerDivs.length; i++) {
    //         AnwaltIds[i] = innerDivs[i].getAttribute('data-id');
    //     }
    // }
    //
    //
    // AnwaltsprofilPosts = document.getElementsByClassName('anwaltsprofil-post');
    // for (var i = 0; i < AnwaltsprofilPosts.length; i++) {
    //     AnwaltsprofilPosts[i].addEventListener('click', ShowPopups, false);
    // }

   /* AnwaltsprofilPopup = document.getElementsByClassName('close-button');
    for (var i = 0; i < AnwaltsprofilPopup.length; i++) {
        AnwaltsprofilPopup[i].addEventListener('click', HidePopups, false);
    }*/


    $('.close_anwalt').on('click', function(){
        $('#anwaltsprofil-popup-wrapper').hide();
        $('.anwaltsprofil-popup').hide();
        $('#mCSB_1_scrollbar_vertical').css("visibility", "visible");
    });



    // function ShowPopups() {
    //     target = '#anwaltsprofil-popup-' + this.getAttribute('data-id');
    //
    //     $("#anwaltsprofil-popup-wrapper").show();
    //     $('.anwaltsprofil-popup').hide();
    //     $("#mCSB_1_scrollbar_vertical").hide();
    //
    //     $(target).show();
    // }

  /*  function HidePopups() {
        poptarget = '#anwaltsprofil-popup-' + this.getAttribute('datapopid');

        // if ($("#anwaltsprofil-popup-wrapper").css("visibility") == "visible") {
        $("#anwaltsprofil-popup-wrapper").css("visibility", "hidden");
        $(poptarget).css("visibility", "hidden");

        $("#mCSB_1_scrollbar_vertical").css("visibility", "visible");
        // }
    }*/



    $("#ra_popup_close").on( "click", function() {
        $("#anwaltsprofil-popup-wrapper").css("visibility", "hidden").css("display", "none");
        $("#mCSB_1_scrollbar_vertical").css("visibility", "visible");
    });

    //Branchen ansteuern von Anwälte
    //nehme eine globale klasse der btn
    $('.open-branchen-popup').on('click', function () {
        var flag = true;
        var id = $(this).attr('class').replace('open-branchen-popup', '').replace('open-branchen-id-', '').replace(' ', '');

        $('.branchen-popup').hide();
        $('#beratung_branchen_headline').show();
        $('#branchen').show();

        $('html, body').animate({
            scrollTop: $('#beratung').offset().top - $('.site-header').height() + 'px'
        }, 750, 'linear', function () {
            if (flag) {
                $('#beratung_branchen_headline').hide();
                $('#branchen').hide();
                $('#branchen-popup-' + id + '').show();
                // SwapDivsWithClick('branchen', 'branchen-popup-' + id + '', 'beratung_branchen_headline');
                flag = false;
            }
        });
        return false;
    });

    //Anwälte ansteuern von Branchen
    $('.ra-related .anwaltsprofil-post').on('click', function () {
        id = $(this).attr('id').replace('branchen-anwaltsprofil-', '');

        $('.anwaltsprofil-popup').hide();
        $('#anwaltsprofil-' + id + '').trigger("click");

        $('html, body').animate({
            scrollTop: $('#profile').offset().top - $('.site-header').height() + 'px'
        }, 750, 'linear', function () {

        });
        return false;
    });


    $('.opennews').on('click', function () {
        id = $(this).attr('id').replace('newsid-', '');
        $('#postid_' + id).slideDown();
        return false;
    });

    /* ---------------------------------------------------------------------------
     * BRANCHEN
     * --------------------------------------------------------------------------- */
    $('.branchen-post-link').on('click', function(){

        var branchenID = $(this).attr('class').replace('branchen-post-link', '').replace('branchen-post-id-', '').replace(' ', '');

        $('#beratung_branchen_headline').hide();
        $('#branchen').hide();
        $('#branchen-popup-' + branchenID + '').show();

        $('html, body').animate({
            scrollTop: $('#beratung').position().top - $('.site-header').height() + 'px'
        }, 500, 'linear');


    });


    $('.close_branchen').on('click', function(){

        var branchenCloseID = $(this).attr('class').replace('close_branchen', '').replace('branchen-close-id-', '').replace(' ', '');

        $('#branchen-popup-' + branchenCloseID + '').hide();
        // $('#beratung_branchen_headline').show();
        $('#beratung_branchen_headline').show();
        $('#branchen').show();
    });

    // function SwapDivsWithClick(div1,div2,div3)
    // {
    //     d1 = document.getElementById(div1);
    //     d2 = document.getElementById(div2);
    //     d3 = document.getElementById(div3);
    //
    //     if ( d2.style.display == "none" ) {
    //         d1.style.display = "none";
    //         d2.style.display = "block";
    //         // d3.style.display = "none";
    //         // d3.addClass('activeAktuelles');
    //     }
    //     else {
    //         d1.style.display = "block";
    //         d2.style.display = "none";
    //         // d3.style.display = "block";
    //     }
    // }


    /* ---------------------------------------------------------------------------
    * AKTUELLES
    * --------------------------------------------------------------------------- */

    $('.aktuelles-post a.button').on('click', function(){
        $('.activeAktuelles').removeClass('activeAktuelles');
        $(this).parent().addClass('activeAktuelles');
        $id = $(this).attr('href').replace('#aktuelles-','');
        $('.aktuelles-popup').hide();
        $('.aktuelles-popup-'+$id).show()
    });

    $('.close_aktuelles').on('click', function(){
        $('.activeAktuelles').removeClass('activeAktuelles');
        $(this).parent().hide();
    });





})(jQuery);
(function ($) {

    $(document).on('ready', function () {

        $(".btn-clap.gedenk").toggle(function(){
            $(this).text("ARTIKEL VERBERGEN").siblings(".clap").show('200');
            $(this).addClass("open");

            // $('#textDots').hide();
            // $('#hiddenText').show('200');
            // document.getElementById("textDots").style.display="none";
            // document.getElementById("hiddenText").style.display="inline";
        }, function(){
            $(this).text("LESEN SIE WEITER").siblings(".clap").hide('200');
            $(this).removeClass("open");

            // $('#textDots').show();
            // $('#hiddenText').hide('200');

        });

        $(".btn-clap").toggle(function(){
            $(this).text("Informationen VERBERGEN").siblings(".clap").show('200');
            $(this).addClass("open");
        }, function(){
            $(this).text("Weitere Informationen").siblings(".clap").hide('200');
            $(this).removeClass("open");
        });

    });

})(jQuery);
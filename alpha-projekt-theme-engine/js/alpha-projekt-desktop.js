(function ($) {

    $(document).on('ready', function () {
        $('.projekt-popup-link').click(function(){
            var id = $(this).attr('class').replace('projekt-popup-link', '').replace('link-id-', '').replace(' ', '');
            var popupId = 'myNav-' + id + '';
            var popupElement = document.getElementById( popupId );
            popupElement.style.visibility = "visible";
            popupElement.style.opacity = "1";
            // document.getElementById( popupId ).style.display = "block";
            document.getElementsByTagName("html")[0].style.overflow = "hidden";
            document.getElementsByTagName("body")[0].style.overflow = "hidden";
        });

        $('.popup-close').click(function(){
            var id = $(this).attr('class').replace('popup-close', '').replace('close-', '').replace(' ', '');
            // console.log(id);
            var popupId = 'myNav-' + id + '';
            var popupElement = document.getElementById( popupId );
            popupElement.style.visibility = "hidden";
            popupElement.style.opacity = "0";
            // document.getElementById( popupId ).style.display = "block";
            document.getElementsByTagName("html")[0].style.overflow = "visible";
            document.getElementsByTagName("body")[0].style.overflow = "visible";
        });


        $('.projekt-float:not(.float-text)').click(function(){
            $(".projekt-float").each(function(){
                $(this).removeClass('float-clicked');
            });
            $(this).addClass('float-clicked');
        });

        $('.float-text').click(function(){
            $(".projekt-float").each(function(){
                $(this).removeClass('float-clicked');
            });

        });

    });

})(jQuery);

// function closeNav() {
//     document.getElementById("myNav").style.display = "none";
//     document.getElementsByTagName("html")[0].style.overflow = null;
//     document.getElementsByTagName("body")[0].style.overflow = null;
// }
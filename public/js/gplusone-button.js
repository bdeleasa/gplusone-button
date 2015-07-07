(function($) {

    $(document).ready(function() {

        setTimeout(function() {
            loadGooglePlusButton();
        }, 3000);

    });


    function loadGooglePlusButton()
    {
        if (typeof (gapi) != 'undefined') {
            $(".g-plusone").each(function () {
                gapi.plusone.render($(this).get(0));
            });
        } else {
            $.getScript('https://apis.google.com/js/plusone.js');
        }
    }

})(jQuery);
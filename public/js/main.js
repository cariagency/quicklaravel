(function ($) {
    $('document').ready(function () {
        // Scrollers.
        if ($('#scrollers').length) {
            $("#scrollers a[href='#top']").click(function (e) {
                e.preventDefault();
                $("html").animate({scrollTop: 0});
                return false;
            });

            $("#scrollers a[href='#bottom']").click(function (e) {
                e.preventDefault();
                $("html").animate({scrollTop: $("body").height()});
                return false;
            });
        }

        // Delete form.
        if ($('#delete-form').length) {
            $('button[data-action]').click(function () {
                if (confirm($('#delete-form').data('confirm'))) {
                    $('#delete-form').attr('action', $(this).data('action')).submit();
                }
            });
        }

        // Password fields.
        $('[type="password"]').val('');
    });
}(jQuery));

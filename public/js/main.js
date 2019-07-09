(function ($) {
    /*
     * CONFIG
     */

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*
     * UTILS
     */

    function init(test, fn) {
        if (typeof test !== 'boolean') {
            test = ($(test).length > 0);
        }

        if (!test || typeof fn !== 'function') {
            return;
        }

        $('document').ready(fn);
    }

    /*
     * INIT
     */

    // Scrollers.
    init('#scrollers', function () {
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
    });

    // Delete form.
    init($('#delete-form').length === 1 && $('[data-delete]').length > 0, function () {
        $('button[data-action]').click(function () {
            if (confirm($('#delete-form').data('confirm'))) {
                $('#delete-form').attr('action', $(this).data('action')).submit();
            }
        });
    });

    // Upload-block.
    init('.upload-block', function () {
        $('.upload-block').uploadBlock({
            url: route('upload'),
            accept: '.png,.jpg,.jpeg',
            thumbnail: true,
            fileUrl: function (path) {
                return route('uploaded', {filename: path});
            }
        });

        $('.upload-block')
                .on('uploadblock.start', function (e) {
                    $('.invalid-feedback', $(this)).remove();
                    $('.is-invalid', $(this)).removeClass('is-invalid');
                    $(this).addClass('loading');
                })
                .on('uploadblock.fail', function (e) {
                    $('.form-group, .form-group input', $(this)).addClass('is-invalid');
                    $('.form-group input', $(this)).after('<div class="invalid-feedback">Une erreur s\'est produite lors de l\'envoi du fichier.</div>')
                })
                .on('uploadblock.always', function (e) {
                    $(this).removeClass('loading');
                });
    });

    // Password fields.
    init('[type="password"]', function () {
        $('[type="password"]').val('');
    });
}(jQuery));

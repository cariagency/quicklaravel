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

    $.fn.uploadBlock = function (opt) {
        // Configuration.
        var opt = $.extend({
            accept: '*',
            url: false,
            fileUrl: function (path) {
                return path;
            }
        }, opt);

        if (!opt.url) {
            console.error('Cannot init upload block : no url provided.');
            return;
        }

        function refresh($t, trigger, triggerData) {
            var val = $('[type="text"]', $t).val();

            if (val !== '') {
                var url = opt.fileUrl(val);

                $('.preview img', $t).on('load', function () {
                    $t.trigger('uploadblock.imgLoaded');
                }).attr('src', url);
            }

            $('.btn-add', $t).toggleClass('hidden', val !== '');

            $('.preview', $t).toggleClass('hidden', val === '');

            $t.trigger('uploadblock.refresh', [val]);

            if (trigger) {
                $t.trigger(trigger, triggerData);
            }
        }

        // Loop on nodes.
        return this.each(function () {
            var $t = $(this);

            refresh($t);

            $('.btn-add [type="file"]', $t).attr('accept', opt.accept).fileupload({
                dataType: 'json',
                url: opt.url,
                type: 'POST',
                submit: function (e, data) {
                    if (opt.formData) {
                        data.formData = (typeof opt.formData === 'function') ? opt.formData($t) : opt.formData;
                    }
                },
                start: function () {
                    $t.trigger('uploadblock.start');
                },
                fail: function () {
                    $t.trigger('uploadblock.fail', arguments);
                },
                done: function (e, data) {
                    if (typeof data.result.path === 'undefined') {
                        $t.trigger('uploadblock.fail', [data]);
                        return;
                    }

                    $('[type="text"]', $t).val(data.result.path);
                    refresh($t, 'uploadblock.done', [data.result.path]);
                },
                always: function () {
                    $t.trigger('uploadblock.always');
                }
            });

            $('.btn-delete', $t).click(function (e) {
                e.preventDefault();
                $('[type="text"]', $t).val('');
                refresh($t, 'uploadblock.delete');
            });
        });
    };

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
    init($('#delete-form').length === 1 && $('[data-action]').length > 0, function () {
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

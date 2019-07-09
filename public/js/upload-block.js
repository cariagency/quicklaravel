(function ($) {
    $.fn.uploadBlock = function (opt) {
        // Configuration.
        var opt = $.extend({
            accept: '*',
            url: false,
            thumbnail: false,
            formData: null,
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
}(jQuery));

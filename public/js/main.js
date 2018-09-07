(function ($) {
    function initDeleteForm() {
        if (!$('#delete-form').length) {
            return;
        }

        $('button[data-action]').click(function () {
            if (confirm($('#delete-form').data('confirm'))) {
                $('#delete-form').attr('action', $(this).data('action')).submit();
            }
        });
    }

    $('document').ready(function () {
        initDeleteForm();
    });
}(jQuery));

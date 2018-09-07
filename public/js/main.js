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

    function initUserForm() {
        if (!$('#user-form').length) {
            return;
        }

        $('#user-form [type="password"]').val('');
    }

    $('document').ready(function () {
        initDeleteForm();
        initUserForm();
    });
}(jQuery));

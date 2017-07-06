$(function () {

    $('.e_search__input').keyup(function () {
        var query = new RegExp($(this).val(), 'i');

        $('.b_thread-node').each(function () {
            if(!$(this).html().match(query)) {
                $(this).hide();
            }
            else {
                $(this).show();
            }
        });
    });

    $('.e_thread__new-node-create').click(function () {
        if($('.e_thread__new-node-text').val()) {
            $(this).prop('disabled', 'disabled');
        }

        $.post(
            'controllers/nodes.php?action=create',
            {
                "tid": $('.e_thread__title').attr('data-id'),
                "text": $('.e_thread__new-node-text').val()
            },
            function (data) {
                if(data == 'success') {
                    location.reload();
                }
                else {
                    alert(data);
                }
            }
        );
    });

    $('.b_thread-node').on('click', '.e_thread-node__edit', function () {
        $(this).parent().parent().parent().parent().parent().find('.e_thread-node__text')
            .prop('contenteditable', 'true')
            .focus();
        $(this)
            .html('<i class="icon-ok" title="Сохранить сообщение"></i>')
            .addClass('e_thread-node__save')
            .removeClass('e_thread-node__edit');
    });

    $('.b_thread-node').on('click', '.e_thread-node__save', function () {
        var node = $(this).parent().parent().parent().parent().parent();
        var text_field = node.find('.e_thread-node__text');

        text_field.prop('contenteditable', 'false');

        $(this)
            .html('<i class="icon-pencil" title="Изменить сообщение"></i>')
            .addClass('e_thread-node__edit')
            .removeClass('e_thread-node__save');

        $.post(
            'controllers/nodes.php?action=edit',
            {
                "nid": node.attr('data-id'),
                "text": text_field.html()
            }
        );
    });

});

$(function () {

    $('.e_new-thread__create').click(function () {
        if($('.e_new-thread__title').val() && $('.e_new-thread__text').val()) {
            $(this).prop('disabled', 'disabled');
        }

        $.post(
            'controllers/threads.php?action=create',
            {
                "title": $('.e_new-thread__title').val(),
                "section": $('.e_new-thread__section').val(),
                "text": $('.e_new-thread__text').val(),
            },
            function (data) {
                if(!data.match(/[а-я]/)) {
                    location.replace('?page=thread&tid=' + data);
                }
                else {
                    alert(data);
                }
            }
        );
    });

});

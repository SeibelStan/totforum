$(function () {

    $('.e_profile_save').click(function () {
        $.post(
            'controllers/users.php?action=edit',
            {
                "name": $('.e_profile__name').val(),
                "bdate": $('.e_profile__bdate').val(),
                "contacts": $('.e_profile__contacts').val(),
                "photo": $('.e_profile__photo-src').val(),
            },
            function (data) {
                if(data == 'success') {
                    alert('Сохранено');
                }
            }
        );
    });

});

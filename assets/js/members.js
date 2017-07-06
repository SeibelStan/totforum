$(function () {

    $('.e_search__input').keyup(function () {
        var query = new RegExp($(this).val(), 'i');

        $('.b_member').each(function () {
            if(!$(this).html().match(query)) {
                $(this).hide();
            }
            else {
                $(this).show();
            }
        });
    });

});

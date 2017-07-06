function checkHide(event, selector) {
	if($(selector).has(event.target).length === 0) {
		$(selector).removeClass('expanded');
	}
}

$(function () {

    $(document).mouseup(function (e) {
		checkHide(e, '.b_main-navigation');
		checkHide(e, '.b_login-panel');
	});

    $('.e_site-header__menu').click(function () {
        $('.b_main-navigation').toggleClass('expanded');
        $('.b_login-panel').toggleClass('expanded');
    });

	$('.e_login-panel__user-register').click(function () {
		$.post(
			'controllers/users.php?action=register',
			{
				"email": $('.e_login-panel__user-login').val(),
				"pass": $('.e_login-panel__user-pass').val()
			},
			function (data) {
				if(data == 'success') {
					location.replace('?page=user');
				}
				else {
					alert(data);
				}
			}
		);
	});

	$('.e_login-panel__user-auth').click(function () {
		$.post(
			'controllers/users.php?action=login',
			{
				"email": $('.e_login-panel__user-login').val(),
				"pass": $('.e_login-panel__user-pass').val()
			},
			function (data) {
				if(data == '') {
					location.reload();
				}
				else {
					alert(data);
				}
			}
		);
	});

});

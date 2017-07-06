<?php
    include('init.php');
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <link rel="icon" href="favicon.png">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/fontello.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="assets/js/core.js"></script>

    <title><?= SITE_NAME ?></title>
</head>

<body>
    <header class="b_site-header">
        <nav class="b_main-navigation">
            <a class="e_site-header__menu" title="Меню"><i class="icon-menu"></i></a>
            <ul class="e_main-navigation__list">
                <?php if(USER_ID) : ?>
                    <li class="e_main-navigation__link"><a href="?page=user"><i class="icon-user"></i> <?= USER_NAME; ?></a></li>
                <?php endif; ?>
                <li class="e_main-navigation__link"><a href="?page=forum"> <i class="icon-home"></i> Форум</a></li>
                <li class="e_main-navigation__link"><a href="?page=members"> <i class="icon-users"></i> Все мы</a></li>
                <li class="e_main-navigation__link"><a href="?page=about"> <i class="icon-attention-circled"></i> О проекте</a></li>
            </ul>
            <div class="b_site-header-right">
                <div class="b_search">
                    <input type="text" class="e_search__input" placeholder="Поиск">
                    <i class="e_search__icon icon-search"></i>
                </div>
            </div>
        </nav>
        <?php if(!USER_ID) : ?>
        <div class="b_login-panel" method="post" action="controllers/users.php?action=login">
            <input type="text" class="e_login-panel__user-login" placeholder="e-mail">
            <input type="password" class="e_login-panel__user-pass" placeholder="Пароль">
            <button class="e_login-panel__user-auth primary">Войти</button><!--
            --><button class="e_login-panel__user-register">Создать</button>
        </div>
        <?php endif; ?>
    </header>

    <main class="b_site-content">
        <?php
            if(!$page = $_GET['page']) {
                $page = 'forum';
            }
            if(file_exists('pages/' . $page . '.php')) {
                include('pages/' . $page . '.php');
            }
        ?>
    </main>
</body>
</html>

<?php
    $uid = $_GET['uid'];

    if(!$uid) {
        if(!USER_ID) {
            header('Location: ?page=forum');
        }

        $me = true;
        $uid = USER_ID;
    }
    else {
        $me = false;
    }

    $result = mysql_query("SELECT * FROM users WHERE id = '$uid'");
    if(mysql_num_rows($result)) {
        $user = mysql_fetch_array($result);
        $user_id = $user['id'];
        $user_name = $user['name'];
        $user_bdate = $user['bdate'];
        $user_contacts = $user['contacts'];
        $user_photo = $user['photo'];
        $user_rules = $user['rules'];
    }
    else {
        $nofound = true;
    }
?>

<script src="assets/js/user.js"></script>

<div class="b_profile">
    <?php if($me) : ?>
        <input type="text" class="e_profile__name" value="<?= $user_name; ?>" placeholder="Имя">
        <input type="text" div class="e_profile__bdate" value="<?= $user_bdate; ?>" placeholder="Дата рождения" title="ДД.ММ.ГГГГ">
        <input type="text" class="e_profile__photo-src" value="<?= $user_photo ?>" placeholder="Ссылка на фото">
        <textarea class="e_profile__contacts" placeholder="Контакты"><?= $user_contacts; ?></textarea>
        <button class="e_profile_save primary"><i class="icon-ok"></i> Сохранить</button>
        <a href="?page=user&uid=<?= USER_ID; ?>"><i class="icon-user"></i> Просмотр</a>
        <a href="controllers/users.php?action=logout"><i class="icon-logout"></i> Выйти</a>
    <?php else : ?>
        <?php if(!$nofound) : ?>
            <div class="e_profile__photo" style="background-image: url(<?= $user_photo ?>)"></div><!--
            --><div class="b_profile-sec-block">
                <div class="e_profile__name">
                    <?= $user_name; ?>
                    <?php
                        if(USER_RULES == 0) {
                            switch($user_rules) {
                                case 0: {
                                    echo '<i title="Администратор" class="icon-eye"></i>';
                                    break;
                                }
                                case 1: {
                                    echo '<a href="controllers/users.php?action=rules&val=2&uid=' . $user_id . '" title="Сделать обычным"><i class="icon-star"></i></a>';
                                    break;
                                }
                                case 2: {
                                    echo '<a href="controllers/users.php?action=rules&val=3&uid=' . $user_id . '" title="Заблокировать"><i class="icon-star-empty"></i></a>';
                                    break;
                                }
                                case 3: {
                                    echo '<a href="controllers/users.php?action=rules&val=1&uid=' . $user_id . '" title="Сделать особым"><i class="icon-lock"></i></a>';
                                    break;
                                }
                            }
                        }
                        else {
                            echo rules_icon($user_rules);
                        }
                    ?>
                </div>
                <div div class="e_profile__bdate"><?= $user_bdate; ?></div>
            </div>
            <div class="e_profile__contacts">
                <?php if($user_contacts) : ?>
                    <h2 class="sub-heading">О пользователе</h2>
                    <?= parse_contacts($user_contacts); ?>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <h1 class="heading">Такого у нас нет</h1?
        <?php endif; ?>
    <?php endif; ?>
</div>

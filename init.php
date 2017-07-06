<?php

include('connect.php');

define(SITE_NAME, 'Форум');
define(PASS_SALT, 'totf');

session_start();

define(USER_ID, $_SESSION['user_id']);

if(USER_ID) {
    $result = mysql_query("SELECT rules FROM users WHERE id = '" . USER_ID . "'");
    $rules = mysql_fetch_array($result);
    define(USER_RULES, $rules['rules']);
}
else {
    define(USER_RULES, 3);
}

$_SESSION['user_name'] = ($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Аноним';
define(USER_NAME, $_SESSION['user_name']);
define(USER_PHOTO, $_SESSION['user_photo']);



function input_filter($data) {
    $data = strip_tags($data);
    $data = mysql_real_escape_string($data);
    $data = trim($data);

    return $data;
}

function date_reformat($data) {
    $data = preg_replace('/(\d+)-(\d+)-(\d+) (\d+:\d+:\d+)/', '$4 $3.$2.$1', $data);
    return $data;
}

function text_format($data) {
    $data = preg_replace('/(\s+)/', '$1', $data);
    $data = preg_replace("/\n/", '<br>', $data);
    return $data;
}

function rules_icon($rules) {
    switch($rules) {
        case 0: {
            return '<i title="Администратор" class="icon-eye"></i>';
            break;
        }
        case 1: {
            return '<i title="Особый" class="icon-star"></i>';
            break;
        }
        case 2: {
            return '<i title="Обычный" class="icon-star-empty"></i>';
            break;
        }
        case 3: {
            return '<i title="Заблокированный" class="icon-lock"></i>';
            break;
        }
    }
}

function parse_contacts($data) {
    $data = preg_replace('/vk:\s*(.+)/i', '<i class="icon-vk"></i> <a href="https://vk.com/$1">$1</a>', $data);
    $data = preg_replace('/skype:\s*(.+)/i', '<i class="icon-skype-1"></i> <a href="skype:$1?add">$1</a>', $data);
    $data = preg_replace('/icq:\s*(.+)/i', '<i class="icon-icq"></i> <a href="http://icq.com/people/$1">$1</a>', $data);
    $data = preg_replace('/ok:\s*(.+)/i', '<i class="icon-odnoklassniki"></i> <a href="http://ok.ru/profile/$1">$1</a>', $data);
    $data = preg_replace('/e-*mail:\s*(.+)/i', '<i class="icon-email"></i> <a href="mailto:$1">$1</a>', $data);
    $data = preg_replace('/g-*plus:\s*(.+)/i', '<i class="icon-gplus"></i> <a href="https://plus.google.com/$1">$1</a>', $data);
    $data = preg_replace('/instagram:\s*(.+)/i', '<i class="icon-instagram"></i> <a href="http://instagram.com/$1">$1</a>', $data);
    $data = preg_replace('/twitter:\s*(.+)/i', '<i class="icon-twitter"></i> <a href="https://twitter.com/$1">$1</a>', $data);
    $data = preg_replace('/youtube:\s*(.+)/i', '<i class="icon-youtube"></i> <a href="https://www.youtube.com/user/$1">$1</a>', $data);
    $data = preg_replace('/tel:\s*(.+)/i', '<i class="icon-call"></i> <a href="tel:$1">$1</a>', $data);
    $data = preg_replace('/\n/', '<br>', $data);
    return $data;
}

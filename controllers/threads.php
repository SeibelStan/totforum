<?php

include('../init.php');

$action = $_GET['action'];

switch($action) {
    case 'create': {
        $title = input_filter($_POST['title']);
        $text = input_filter($_POST['text']);

        if(USER_ID && USER_RULES < 3 && $title && $text) {
            $section = input_filter($_POST['section']);
            $tid = uniqid();
            $nid = uniqid();

            mysql_query("INSERT INTO threads (id, author, section, title) VALUES ('$tid', '" . USER_ID . "', '$section', '$title')");
            mysql_query("INSERT INTO nodes (id, author, thread, text) VALUES ('$nid', '" . USER_ID . "', '$tid', '$text')");

            echo $tid;
        }
        else {
            echo 'Проверьте текст и заголовок';
        }

        break;
    }

    case 'close': {
        if(USER_RULES == 0) {
            $val = input_filter($_GET['val']);
            $tid = input_filter($_GET['tid']);

            mysql_query("UPDATE threads SET closed=$val WHERE id = '$tid'");

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        break;
    }

    case 'delete': {
        if(USER_RULES == 0) {
            $tid = input_filter($_GET['tid']);

            mysql_query("DELETE FROM threads WHERE id = '$tid'");
            mysql_query("DELETE FROM nodes WHERE thread = '$tid'");

            header('Location: ../?page=forum');
        }

        break;
    }
}

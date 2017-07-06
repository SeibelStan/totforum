<?php

include('../init.php');

$action = $_GET['action'];

switch($action) {
    case 'create': {
        $text = input_filter($_POST['text']);

        if(USER_ID && USER_RULES < 3 && $text) {
            $section = input_filter($_POST['section']);
            $tid = input_filter($_POST['tid']);
            $nid = uniqid();

            mysql_query("INSERT INTO nodes (id, author, thread, text) VALUES ('$nid', '" . USER_ID . "', '$tid', '$text')");

            echo 'success';
        }
        else {
            echo 'Проверьте текст';
        }

        break;
    }

    case 'delete': {
        if(USER_RULES == 0) {
            $nid = input_filter($_GET['nid']);

            mysql_query("DELETE FROM nodes WHERE id = '$nid'");

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        break;
    }

    case 'edit': {
        if(USER_RULES < 3) {
            $nid = input_filter($_POST['nid']);
            $text = input_filter($_POST['text']);

            mysql_query("UPDATE nodes SET text='$text', edited=1 WHERE id = '$nid'");
            echo 'ok';
        }

        break;
    }
}

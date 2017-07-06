<?php

include('../init.php');

$action = $_GET['action'];

switch($action) {
    case 'register': {
        $email = strtolower(input_filter($_POST['email']));

        if(preg_match('/.+@.+/', $email)) {
            $result = mysql_query("SELECT * FROM users WHERE email = '$email' LIMIT 1");
            if(!mysql_num_rows($result)) {
                $uid = uniqid();
                $pass = md5($email . input_filter($_POST['pass']) . PASS_SALT);
                mysql_query("INSERT INTO users (id, email, pass, name) VALUES ('$uid', '$email', '$pass', 'Новичок')");

                echo 'success';
            }
            else {
                die('Пользователь с таким e-mail уже есть');
            }
        }
        else {
            die('Неправильный e-mail');
        }

        //break; Протекание создано с целью автоматического логина
    }

    case 'login': {
        $email = strtolower(input_filter($_POST['email']));
        $pass = md5($email . input_filter($_POST['pass']) . PASS_SALT);
        $result = mysql_query("SELECT * FROM users WHERE email = '$email' AND pass = '$pass' LIMIT 1");
        if(mysql_num_rows($result)) {
            $user = mysql_fetch_array($result);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_bdate'] = $user['bdate'];
            $_SESSION['user_photo'] = $user['photo'];
        }
        else {
            echo 'Неправильный e-mail или пароль';
        }

        break;
    }

    case 'logout': {
        session_destroy();

        header('Location: ../?page=forum');

        break;
    }

    case 'rules': {
        if(USER_RULES == 0) {
            $val = $_GET['val'];
            $uid = $_GET['uid'];

            mysql_query("UPDATE users SET rules=$val WHERE id = '$uid'");

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        break;
    }

    case 'edit': {
        $name = input_filter($_POST['name']);
        $name = ($name) ? $name : 'Аноним';
        $_SESSION['user_name'] = $name;
        $bdate = input_filter($_POST['bdate']);
        $contacts = input_filter($_POST['contacts']);
        $photo = input_filter($_POST['photo']);
        $photo = ($photo) ? $photo : 'assets/img/nophoto.png';
        $_SESSION['user_photo'] = $photo;

        mysql_query("UPDATE users SET name='$name', bdate='$bdate', contacts='$contacts', photo='$photo' WHERE id = '" . USER_ID . "'");

        echo 'success';

        break;
    }
}

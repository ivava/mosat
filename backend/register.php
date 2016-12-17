<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 14.10.16
 * Time: 0:03
 */
require ("config.php");

if (isset($_POST['register'])) {
if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username'])) {
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
   $user = new User($full_name, $username, $email, $password);
    $ins = $user->insert();

    if ($ins == FALSE) {
        echo "Ошибка";
    } else {
        session_start();
        $_SESSION['session_username'] = $user->login;
        header("location: ../frontend/intro.php");
    }
} else {
    echo "Необходимо заполнить все поля";
}
}

?>
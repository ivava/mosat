<?php
session_start();
?>
<?php

require ("config.php");
?>

<?php
if (isset($_SESSION["session_username"])) {
    header("location: ../frontend/intro.php");
}
if (isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $userData = User::getUserData($username, $password);
        if ($userData['username'] == $username && $userData['password'] == $password) {
            $_SESSION['session_username'] = $username;
            header("Location: ../frontend/intro.php");
        } else {
            $_SESSION['error_log'] = 1;
            header("Location: ../frontend/login.php");
        }

//        $au = User::ValidUser($username, $password);
//        if ($au['username'] == $username && $au['password'] == $password) {
//           $_SESSION['session_username'] = $username;
//            header('Location: ../fronted/intro.php');
//        } else {
//            echo "no";
//        }
//        if ($au == TRUE) {
//            $_SESSION['session_username'] = $username;
//            header("location: ../frontend/intro.php");
//        } else {
//            echo "Неправильный логин или пароль";
//        }
    } else {
        header("location: ../frontend/login.php");
    }
}
?>

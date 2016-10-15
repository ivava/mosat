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
        $au = User::auth($username, $password);
        $_SESSION['session_username'] = $username;
        header("Location: ../frontend/intro.php");

    } else {
        header("location: ../frontend/login.php");
    }
}
?>

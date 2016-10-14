<?php
session_start();
?>
<?php
require ("config.php");
?>

<?php
if (isset($_SESSION["session_username"])) {
    header("location: ../front/intro.php");
}
if (isset($_POST['login'])) {
    if (!empty($_POST['username']) && !empty($_POST['passwors'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['passwors']);
        User::auth($username, $password);
        echo "c";
    } else {
        echo "Неправильный логин или пароль";
    }
}
?>

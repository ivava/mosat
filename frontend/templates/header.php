<?php
session_start();
include_once ("../backend/config.php");
include_once ("../backend/classes/User.php");
$user = User::getUserByUsername($_SESSION['session_username']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
    <title>Mosat</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

    <script src="assets/libs/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="assets/libs/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <script src="https://use.fontawesome.com/712fa4a1f3.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/animate.css">

    <script src="assets/js/bootstrap.js"></script>

</head>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid main-navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                <span class="sr-only">MOSAT</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand"><img src="assets/img/logo.png" alt="logo mosat"></a>
        </div>
        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="nav navbar-nav">
                <li><a href="#">Новинки</a></li>
                <li><a href="#">Топ 100</a></li>
                <li><a href="lenta.php">Лента</a></li>
                <li><a href="#">Плейлист</a></li>
                <li class="active"><a href="download.php">Загрузить</a></li>
                <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right alarm">
                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a><li>
                <li><a href="#"><i class="fa fa-bell" aria-hidden="true"></i>
                    </a></li>
                <li class="dropdown btn-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="header_avatar" src="<?=$user->getAvatar()?>">
                        <?php
                        if (isset($user->login)) {
                            echo $user->login;
                        ?> <b class="caret"></b>
                            <ul class="dropdown-menu">
                                <li><a href="user.php">Профиль</a></li>
                                <li><a href="logout.php">Выйти</a></li>

                            </ul>
                       <?php } else {
                            echo "Логин<b class=\"caret\"></b>";
                        ?>
                        </a>
                    <ul class="dropdown-menu">
                        <li><a href="login.php">Войти</a></li>
                        <li><a href="reg.php">Регистрация</a></li>
                    </ul>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>

</nav>
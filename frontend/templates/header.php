<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

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
            <a href="#" class="navbar-brand">MOSAT</a>
        </div>
        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="nav navbar-nav">
                <li><a href="#">Новинки</a></li>
                <li><a href="#">Топ 100</a></li>
                <li><a href="#">Лента</a></li>
                <li><a href="#">Плейлист</a></li>
                <li class="active"><a href="#">Загрузить</a></li>
                <li><a href="#">Search</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">11</a><li>
                <li><a href="#">22</a></li>
                <li class="dropdown btn-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if (isset($_SESSION['session_username'])) {
                            echo $_SESSION['session_username'] . "<b class=\"caret\"></b>";
                        ?>
                            <ul class="dropdown-menu">
                                <li><a href="logout.php">Выйти</a></li>
                            </ul>
                       <?php } else {
                            echo "Вход/регистрация<b class=\"caret\"></b>";
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
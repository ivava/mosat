<?php
//session_start();

include ("templates/header.php");
require ("../backend/config.php");

if (!isset($_SESSION['session_username'])) {
    header("location: login.php");
} else {
    ?>

<div>
    <h2>Добро пожаловать
    <span>
        <?php echo $_SESSION['session_username']; ?>
    </span>
        <a href="logout.php">Выйти</a>
    </h2>
</div>
    <?php
}
?>

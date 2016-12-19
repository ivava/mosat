<?php
session_start();
require ('config.php');
$user = User::getUserByUsername($_SESSION['session_username']);
if (isset ($_GET['id'])) {
    $user->addFriend($_GET['id']);
}
header("Location: ../frontend/user.php?id=" .$_GET['id']);
<?php
session_start();
require ("config.php");

if (isset($_FILES['avatar'])) {
    $user = User::getUserByUsername($_SESSION['session_username']);
    $id = $user->id;
    $user->setAvatar($id, $_FILES['avatar']);
    header("Location: ../frontend/user.php");
}
?>
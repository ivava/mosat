<?php
//$uploadDir = '../user_file/';
//$uploadFile = $uploadDir . basename($_FILES['music_file']['name']);
//if (move_uploaded_file($_FILES['music_file']['tmp_name'], $uploadFile)) {
//    header("Location: ../frontend/download.php");
//} else {
//    echo 'Неудача';
//}
session_start();
include ("config.php");
$user = User::getUserByUsername($_SESSION['session_username']);
$music = new Music();
$music->uploadFile($user->id, $_FILES['music_file']);
echo $user->id;
echo $_SESSION['session_username'];
?>
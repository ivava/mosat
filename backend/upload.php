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
//$music->uploadThumb($music->id, $_FILES['music_thumb']);
$_SESSION['music_id'] = $music->id;
$_SESSION['music_title'] = $music->title;
$SESSION['music_path'] = $music->path;
$_SESSION['music_user_id'] = $music->user_id;
$_SESSION['music_thumb'] = $music->thumb;
header("Location: ../frontend/download.php");
?>
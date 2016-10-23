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
if ($_SESSION['upload'] != 'upload') {
    $user = User::getUserByUsername($_SESSION['session_username']);
    $music = new Music();
    $music->uploadFile($user->id, $_FILES['music_file']);

    $_SESSION['music_id'] = $music->id;
    $_SESSION['music_title'] = $music->title;
    $_SESSION['music_path'] = $music->path;
    $_SESSION['music_user_id'] = $music->user_id;
    $_SESSION['upload'] = 'upload';
} else {
    $music = new Music();
    $music_thumb = $music->uploadThumb($_SESSION['music_id'], $_FILES['music_thumb']);

    $_SESSION['music_thumb'] = $music_thumb;
    $_SESSION['upload'] = 'upload_thumb';
}
header("Location: ../frontend/download.php");

?>
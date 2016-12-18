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
if ($_SESSION['upload'] == '') {

    $user = User::getUserByUsername($_SESSION['session_username']);
    $music = new Music();
    $music->uploadFile($user->id, $_FILES['music_file']);

    $_SESSION['music_id'] = $music->id;
    $_SESSION['music_title'] = $music->title;
    $_SESSION['music_path'] = $music->path;
    $_SESSION['music_user_id'] = $music->user_id;
    $_SESSION['upload'] = 'upload';
}

if (isset($_GET['done'])) {
    $_SESSION['upload'] = '';
    header("Location: ../frontend/mosat.php");
} else {
    $_SESSION['upload'] = '';
    header("Location: ../frontend/edit_audio.php");
}

?>
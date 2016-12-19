<?php
session_start();
include ("config.php");

$music = new Music();
$music_thumb = $music->uploadThumb($_SESSION['music_id'], $_FILES['music_thumb']);

$_SESSION['music_thumb'] = $music_thumb;
$_SESSION['upload'] = 'upload_thumb';
header("Location: ../frontend/edit_audio.php");

?>
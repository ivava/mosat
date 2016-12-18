<?php
session_start();
require ('config.php');
$newTitle = $_POST['music_title'];
$music = Music::getMusicById($_SESSION['music_id']);
$new_author = $_POST['music_author'];
if (isset($newTitle)) {
    $music->updateTitle($newTitle);
    $_SESSION['music_title'] = $music->title;
}
if (isset($new_author)) {
    $music->updateAuthor($new_author);
    $_SESSION['music_author'] = $music->author;
}
header('location: ../frontend/edit_audio.php');
?>




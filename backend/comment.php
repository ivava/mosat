<?php
require ("config.php");

if (isset($_POST['comment']) && isset($_POST['author']) && isset($_POST['music_id'])) {
    $comment = new Comment();
    $comment->setContent($_POST['comment']);
    $comment->setAuthor($_POST['author']);
    $comment->setMusicId($_POST['music_id']);
    $comment->setComment();
    header("Location: ../frontend/mosat.php?id=" .$comment->musicId);
}

?>


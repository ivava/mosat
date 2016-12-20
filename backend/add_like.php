<?php
require ("config.php");


if (isset($_GET['id'])) {
    $user = User::getUserByUsername($_SESSION['session_username']);
    $music = Music::getMusicById($_GET['id']);
    if (!$user->isLiked($music->id)) {
        $music->addLike();
        $user->addToLikedMusic($user->id, $music->id);
    }
}
header("Location: ../frontend/mosat.php?id=" .$_GET['id']);


<?php
session_start();
require ("config.php");

if (isset($_GET['id']) && isset($_GET['us_id'])) {
    $user = User::getUserByIdObj($_GET['us_id']);
    $music = Music::getMusicById($_GET['id']);

    if ($user->isLiked($music->id) != 1) {
        $music->addLike();
        $user->addToLikedMusic($user->id, $music->id);
    } else {
        $music->deleteLike();
        $user->deleteLikeMusic($music->id);
    }
    header("Location: ../frontend/mosat.php?id=" .$music->id);
}


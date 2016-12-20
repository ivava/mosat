<?php
require ("config.php");


if (isset($_GET['id'])) {
    $user = User::getUserByUsername($_GET['us_id']);
    $music = Music::getMusicById($_GET['id']);
    if ($user->isLiked($music->id) !== 1) {

        $music->addLike();
        $user->addToLikedMusic($user->id, $music->id);
        print_r($user->getLikedList($user->id));
        echo $user->isLiked($music->id);
    }
}
//header("Location: ../frontend/mosat.php?id=" .$_GET['id']);


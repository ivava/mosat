<?php
session_start();

require ("../backend/config.php");
require ("../backend/classes/User.php");
require ("../backend/classes/Music.php");
$cuser = User::getUserByUsername($_SESSION['session_username']);
$user = User::getUserByUsername('t');
$user->addFriend('12');
$user->addFriend('1');

$user->addFriend('3');
$us = User::getUserByIdObj(1);
$us->addFriend(4);
$us->addFriend(1);
$us->addFriend(5);
echo $cuser->id;
$cuser->addToLikedMusic($cuser->id, 2);
print_r ($cuser->getLikedList($cuser->id));
echo $cuser->isLiked(2);

echo ($us->isFollow(2));

?>
<p>
    <?php

//    foreach ($user as $item) {
//        echo $item . "<br />";
//    }
//    foreach ($user as $stat) {
//        echo $stat['username'];
//    }





    ?>
</p>

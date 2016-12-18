<?php
require ("../backend/config.php");
require ("../backend/classes/User.php");
require ("../backend/classes/Audio.php");
$user = User::getUserByUsername('t');
$user->addFriend('12');
$user->addFriend('1');

$user->addFriend('3');
echo print_r($user) . "<br />";
echo print_r($user->getFriend_list());

?>
<p>
    <?php

//    foreach ($user as $item) {
//        echo $item . "<br />";
//    }
//    foreach ($user as $stat) {
//        echo $stat['username'];
//    }


    $music = new Audio();

    $music->loadFile('../user_file/1/dsd.mp3');
    echo $music->id3_title;
    ?>
</p>

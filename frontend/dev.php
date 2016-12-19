<?php
require ("../backend/config.php");
require ("../backend/classes/User.php");
require ("../backend/classes/Music.php");
$user = User::getUserByUsername('t');
$user->addFriend('12');
$user->addFriend('1');

$user->addFriend('3');
$us = User::getUserByIdObj(2);
$us->addFriend(4);
$us->addFriend(1);


echo ($us->getFriend_list()[2]);

?>
<p>
    <?php

//    foreach ($user as $item) {
//        echo $item . "<br />";
//    }
//    foreach ($user as $stat) {
//        echo $stat['username'];
//    }

    $us = $us->getFriend_list();
    print_r($us);


   $mus = new Music();
    echo $mus->getCount();
    ?>
</p>

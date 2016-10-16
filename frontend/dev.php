<?php
require ("../backend/config.php");
require ("../backend/classes/User.php");
$user = User::getUserById(3);
$us = $user['password'];

?>
<p>
    <?php
echo $user['full_name'];
    echo $user['email'];
    echo $user['username'];
//    foreach ($user as $item) {
//        echo $item . "<br />";
//    }
//    foreach ($user as $stat) {
//        echo $stat['username'];
//    }
    ?>
</p>

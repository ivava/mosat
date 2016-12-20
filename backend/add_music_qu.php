<?php
require ("config.php");
/**
 * Created by PhpStorm.
 * User: Ann
 * Date: 20.12.2016
 * Time: 11:16
 */


if (isset($_GET['id'])) {
    $music = Music::getMusicById($_GET['id']);
    $music->addMusicIncr();
}

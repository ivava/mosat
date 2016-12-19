<?php
include ('templates/header.php');

//require ('../backend/config.php');
require ('../backend/classes/Music.php');
//require ('../backend/classes/User.php');
?>
<div class="container">
    <div class="row">
<?php
$user = User::getUserByUsername($_SESSION['session_username']);

$musicCount = new Music();
$musicCount = $musicCount->getCount();


for ($i = $musicCount; $i > 0; $i--) {
//    if ($i > 8) break;
    $music = Music::getMusicById($i);
    $friendUser = User::getUserByIdObj($music->user_id);

//    $friendUser = new User($rows['full_name'], $rows['username'], $rows['email'], $rows['password'], $rows['id'],
//        $rows['friend_list']s['bio']);

//    $friendUser = User::getUserByUsername($friendUser['login']);, $row
    ?>
    <div class="col-md-4">
        <div class="music_thumb">
            <img src="<?=$music->getMusicThumb()?>" class="img-responsive"/>
        </div>
        <div class="music_title">
            <a href=<?="mosat.php?id=" . $music->id ?> >
            <span>
                <?php echo $music->title ?>
            </span>
                </a>
            <span><?=$music->author?></span>
        </div>
        <div class="music_master">
            <a href="
<?php
     echo 'user.php?id=' . $friendUser->id;
    ?>
">
                <?= $friendUser->login ?>
            </a>
            </div>
    </div>
    </div>

    <?php
}
    ?>
</div>

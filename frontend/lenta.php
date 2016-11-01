<?php
include ('templates/header.php');

require ('../backend/config.php');
require ('../backend/classes/Music.php');
require ('../backend/classes/User.php');
?>
<div class="container">
    <div class="row">
<?php
$musicCount = Music::getAllMusicCount();
print_r($musicCount);


for ($i = 1; $i < 10; $i++) {
    if ($i > 8) break;
    $music = Music::getMusicById($i);
    $friendUser = User::getUserById($music->user_id);
    ?>
    <div class="col-md-4">
        <div class="music_thumb">
            <img src="
<?php echo $music->thumb ?>
" class="img-responsive"
        </div>
        <div class="music_title">
            <span>
                <? echo $music->title ?>
            </span>
        </div>
        <div class="music_master">
            <a href="
<?php
     echo 'profile.php?id=' . $friendUser['id'];
    ?>
">
                <? echo $friendUser['login'] ?>
            </a>
            </div>
    </div>
    </div>

    <?php
}
    ?>
</div>
    </div>
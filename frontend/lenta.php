<?php
include ('templates/header.php');

//require ('../backend/config.php');
require ("../backend/classes/Comment.php");
require ('../backend/classes/Music.php');
//require ('../backend/classes/User.php');
$user = User::getUserByUsername($_SESSION['session_username']);




$comment = new Comment();

?>

<div class="container lenta">
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
            //    $rows['friend_list']s['bio']);
            //    $friendUser = User::getUserByUsername($friendUser['login']);, $row
        ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lenta_item"">
        <div class="music_master">
            <a href="<?php echo 'user.php?id=' . $friendUser->id;?>">
                <img class="header_avatar" src="<?= $friendUser->getAvatar()?>">
                <span><?= $friendUser->login ?></span>
            </a>
        </div>

        <div class="music_thumb">
            <a href=<?="mosat.php?id=" . $music->id ?> >
                <img src="<?=$music->getMusicThumb()?>" class="img-responsive"/>
            </a>
        </div>

        <div class="row text-center music_title">
            <div class="col-md-12 track_info_mosat">
                <a href=<?="mosat.php?id=" . $music->id ?> >
                    <p class="post-album-title">
                        <?php echo $music->title;?>
                    </p>
                    <p class="post-genre-album">
                        <?php echo $music->getMusicAuthor();?>
                    </p>
                </a>
            </div>
            <div class="col-md-4">
                <p class="gray_text pull-right"><i class="fa fa-play" aria-hidden="true"></i>141K</p>
            </div>
            <div class="col-md-4">
                <p class="gray_text"><i class="fa fa-heart" aria-hidden="true"></i><?=$music->getLikeCount();?></p>
            </div>
            <div class="col-md-4">
                <p class="gray_text pull-left"><i class="fa fa-comment" aria-hidden="true"></i><?=$comment->getCommentCount($music->id)?></p>
            </div>
        </div>


    </div>
    <?php
    }
    ?>
    </div>


</div>

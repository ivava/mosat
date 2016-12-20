<?php
include ("templates/header.php");
require ("../backend/classes/Comment.php");
//require ("../backend/config.php");
//require ("../backend/classes/User.php");
require ("../backend/classes/Music.php");
$user = User::getUserByUsername($_SESSION['session_username']);
if (!$_GET['id']) {
	$music = Music::getMusicById($_SESSION['music_id']);
} else {
	$music = Music::getMusicById($_GET['id']);
}
$masterUser = User::getUserByIdObj($music->user_id);
$comment = new Comment();
$comment->getCommentByMusicId($music->id);
$author = $comment->getAuthorObj();



?>


<form action="">
	<input type="hidden" name="hId" id="mId" value="<?=$music->id?>">
	<input type="hidden" name=uId" id="uId" value="<?=$user->id?>">
</form>

	<div class="container lenta">
		<div class="post">
			<div class="row author-post-info">
				<div class="col-md-1">
					<img src="<?=$masterUser->getAvatar()?>" alt="" class="user-prev-avatar">
				</div>
				<div class="col-md-8">
					<p><a href=<?='user.php?id=' . $masterUser->id?>>
							<?php
							echo $user->login;
							?>
						</a></p>
				</div>
				<div class="col-md-3">
					<p class="post-time">26 мин</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 album-logo">
					<img src="<?php echo $music->getMusicThumb();?>" class="full-album-logo">
					<div class="btn-play" id="play">
						<div class="audio_item">
                            <audio id="sound" preload="auto" controls>
	<source src="<?php echo $music->path; ?>" type="audio/mpeg">
</audio>
											</div>
                    </div>

                    <script>
                        var audio = $("#sound")[0];
                        var btn = $(".btn-play");
                        //                        $("#play").click(function() {
                        //                            audio.play();
                        //                        });
                        $("#play").click(function () {
                            if (audio.paused) {
                                audio.play();
                                btn.css('background-image','url(assets/img/pause.png)');

								$.ajax({
									type: 'GET',
									url: '../backend/add_music_qu.php?id=' + <?=$music->id?>
								})

                            } else {
                                audio.pause();
                                btn.css('background-image','url(assets/img/play.png)');
                            }
                        })
                    </script>
                </div>
            </div>
        </div>


			<div class="row text-center">
				<div class="col-md-12 track_info_mosat">
					<p class="post-album-title"><?php
					echo $music->title;
						?></p>

					<p class="post-genre-album">
                        <?php echo $music->getMusicAuthor(); ?>
                    </p>
				</div>
                <div class="otstup col-md-2"></div>
                <div class="col-md-3">
                    <p class="gray_text pull-right"><i class="fa fa-play" aria-hidden="true"></i><?=$music->getMusicIncr()?></p>
                </div>
				<div class="col-md-3">
                    <p class="gray_text">
                            <i class="fa fa-heart" aria-hidden="true"></i><?=$music->getLikeCount();?></p>

				</div>
				<div class="col-md-4">
                    <p class="gray_text pull-left"><i class="fa fa-comment" aria-hidden="true"></i><?=$comment->getCommentCount($music->id)?></p>

                </div>
			</div>


			<div class="row">
                <div class="col-md-2">
                    <a class="like_count" href=<?="../backend/like.php?id=" .$music->id. "&us_id=" .$user->id?>>
                        <i class="fa fa-heart btn_mosat btn_mosat_one" aria-hidden="true"></i></a>
                </div>

				<div class="col-md-8">
					<form method="post" action="../backend/comment.php">
						<input type="hidden" name="author" value="<?=$user->id?>" />
						<input type="hidden" name="music_id" value="<?=$music->id?>" />
					<textarea class="mosat_comment" rows="2" cols="40" placeholder="Ваш комментарий..." name="comment" required></textarea>
                        <div class="send_comment_btn">
                        <a><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
						<input class="send_comment" type="submit" value="Отправить" />
                        </div>
						</form>
				</div>
                <div class="col-md-2 pull-left"><i class="fa fa-plus-circle btn_mosat btn_mosat_two" aria-hidden="true"></i></div>

            </div>
			<div class="row comments">

				<?php
				$commentList = $comment->getAllCommentByMusicId($music->id);
				for ($i = 0; $i < count($commentList); $i++) {
				if ($i > 8) break;
				$currentComment = $commentList[$i];
					$currentAuthor = User::getUserByIdObj($currentComment['author']);
				?>
					<div class="col-md-1">
						<img src=<?=$currentAuthor->getAvatar()?> alt="" class="comment-prev-avatar">
					</div>
				<div class="col-md-11">
					<p class="comment-author"><a href=<?="user.php?id=" . $currentAuthor->id?>><?=$currentAuthor->login?></a></p>
					<p><?=$currentComment['content']?></p>
				</div>

				<?php } ?>
			</div>
			<br>

		</div>
	</div>
	<script src="js/addLike.js"></script>
</body>
</html>
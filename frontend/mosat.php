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
					<img src="
<?php
				echo $music->getMusicThumb();
?>
" class="full-album-logo">
					<div class="btn-play">
						<div class="audio_item">-->
								<audio controls>
													<source src="<?php echo $music->path; ?>" type="audio/mpeg">


													>
												</audio>
											</div>
											<div class="music_title">
											<span>
												<?php
												echo $music->title;
												?>
											</span>
											</div>

					</div>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-md-12">
					<p class="post-album-title"><?php
					echo $music->title;
						?></p>
					<p class="post-genre-album">Deep tune</p>
				</div>
				<div class="col-md-4">
					<p>141K</p>
				</div>
				<div class="col-md-4">
					<p>366</p>
				</div>
				<div class="col-md-4">
					<p>42</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					like
				</div>
				<div class="col-md-8">
					<form method="post" action="../backend/comment.php">
						<input type="hidden" name="author" value="<?=$user->id?>" />
						<input type="hidden" name="music_id" value="<?=$music->id?>" />
					<textarea rows="2" cols="30" placeholder="Написать комментарий" name="comment" required></textarea>
						<input type="submit" value="Отправить" />
						</form>
				</div>
				<div class="col-md-2">+</div>
			</div>
			<div class="row">
				<div class="col-md-1">
					<img src="assets/img/avatar.jpg" alt="" class="comment-prev-avatar">
				</div>
				<?php
				$commentList = $comment->getAllCommentByMusicId($music->id);
				for ($i = 0; $i < count($commentList); $i++) {
				if ($i > 8) break;
				$currentComment = $commentList[$i];
					$currentAuthor = User::getUserByIdObj($currentComment['author']);
				?>
				<div class="col-md-11">
					<p class="comment-author"><a href=<?="user.php?id=" . $currentAuthor->id?>><?=$currentAuthor->login?></a></p>
					<p><?=$currentComment['content']?></p>
				</div>
				<?php } ?>
			</div>
			<br>

		</div>
	</div>
	<?php
	echo print_r($_SESSION);

?>
</body>
</html>
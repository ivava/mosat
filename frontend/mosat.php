<?php
include ("templates/header.php");
require ("../backend/config.php");
require ("../backend/classes/User.php");
require ("../backend/classes/Music.php");
$user = User::getUserByUsername($_SESSION['session_username']);
$music = Music::getMusicById($_SESSION['music_id']);



?>




	<div class="container lenta">
		<div class="post">
			<div class="row author-post-info">
				<div class="col-md-1">
					<img src="assets/img/avatar.jpg" alt="" class="user-prev-avatar">
				</div>
				<div class="col-md-8">
					<p><a href="user.html">
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
					echo $_SESSION['music_thumb'];
?>
" class="full-album-logo">
					<div class="btn-play">

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
					<textarea rows="2" cols="30" placeholder="Написать комментарий"></textarea>
				</div>
				<div class="col-md-2">+</div>
			</div>
			<div class="row">
				<div class="col-md-1">
					<img src="assets/img/avatar.jpg" alt="" class="comment-prev-avatar">
				</div>
				<div class="col-md-11">
					<p class="comment-author"><a href="user.html">Jennycat</a> <span
							class="comment-date">1 месяц назад</span></p>
					<p>Божественно)))</p>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-1">
					<img src="assets/img/avatar.jpg" alt="" class="comment-prev-avatar">
				</div>
				<div class="col-md-11">
					<p class="comment-author"><a href="user.html">pi3denish</a> <span
							class="comment-date">сегодня</span></p>
					<p>Klein, как всегда: в тему, красиво, дорАгА, бАгАтс Так держать!:)</p>
				</div>
			</div>
		</div>
	</div>
	<?php
	echo print_r($_SESSION);

?>
</body>
</html>
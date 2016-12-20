<?php
include ("templates/header.php");
//require ("../backend/classes/User.php");
require ("../backend/classes/Music.php");
//require ("../backend/config.php");
if (!isset($_GET['id'])) {
	$user = User::getUserByUsername($_SESSION['session_username']);
} else {
	$user = User::getUserByIdObj($_GET['id']);
}
$musicList = $user->getMusicList();
$mosatCount = $user->getMosatCount();
$current_user = User::getUserByUsername($_SESSION['session_username']);
?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<img src="<?php
				echo $user->getAvatar();
?>
" alt="" class="user-avatar">
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<h3 class="username"><?php
						echo $user->fullName;
					?></h3>
					<p class="userlogin">@<?php
					echo $user->login;
?></p>
					<?php if (!isset($_GET['id'])) { ?>

					<p><a class="btn btn-primary btn-lg user-subscribe" role="button" href="edit_user.php">Редактировать</a></p>
				<?php	} else { if (!$current_user->isFollow($user->id)) { ?>
					<p><a class="btn btn-primary btn-lg user-subscribe" role="button" href=<?="../backend/follow.php?id=" .$user->id?>>Подписаться</a></p>
				</div><?php } else { ?>
				<p>Вы подписаны</p>
				<a href=<?="../backend/delete_follow.php?id=" .$user->id?>>Отписаться нахуй</a>
				<?php } } ?>
			</div>
			<div class="row">
				<div class="col-md-4"><span class="user-stats"><span class="number"><?=$mosatCount?></span><br>Мосата</span></div>
				<div class="col-md-4"><span class="user-stats"><span class="number"><?=$user->getFollowCount()?></span><br>Подписчиков</span></div>
				<div class="col-md-4"><span class="user-stats"><span class="number"><?=$user->getFriendCount()?></span><br>Подписок</span></div>
			</div>
		</div>
	</div>
	<ul class="nav nav-tabs user-info">
		<li class="active"><a data-toggle="tab" href="#panel1">Мосаты</a></li>
		<li><a data-toggle="tab" href="#panel2">Понравившиеся</a></li>
		<li><a data-toggle="tab" href="#panel3">Биография</a></li>
	</ul>
	<div class="tab-content">
		<div id="panel1" class="tab-pane fade in active">
			<div class="row">
				<?php
				$musicListCount = count($musicList);
				for ($i = 0; $i < $musicListCount; $i++) {
					if ($i > 8) break;
					?>
					<div class="col-md-3">
						<img src="
<?php
						echo $musicList[$i]['thumb'];
					?>
					" class="album-logo">
						<p class="album-title"><?php
					echo $musicList[$i]['title'];
							?></p>
						<p class="album-author">AURTOR</p>
					</div>
					<?php
				}
				?>
<!--				<div class="col-md-3">-->
<!--					<img src="assets/img/2.jpg" class="album-logo">-->
<!---->
<!--					<p class="album-title">--><?php
//						echo $music->title;
//					?>
<!--					</p>-->
<!--					<p class="album-author">Optic</p>-->
<!--				</div>-->
<!--				<div class="col-md-3">-->
<!--					<img src="assets/img/3.jpg" class="album-logo">-->
<!---->
<!--					<p class="album-title">Dubism EP </p>-->
<!--					<p class="album-author">Upwellings</p>-->
<!--				</div>-->
<!--				<div class="col-md-3">-->
<!--					<img src="assets/img/4.jpg" class="album-logo">-->
<!---->
<!--					<p class="album-title">Moment To Dub EP</p>-->
<!--					<p class="album-author">Axs</p>-->
<!--				</div>-->
<!--				<div class="col-md-3">-->
<!--					<img src="assets/img/5.jpg" class="album-logo">-->
<!---->
<!--					<p class="album-title">Singularity</p>-->
<!--					<p class="album-author">Dublicator</p>-->
<!--				</div>-->
<!--				<div class="col-md-3">-->
<!--					<img src="assets/img/6.jpg" class="album-logo">-->
<!---->
<!--					<p class="album-title">Leo Triplet EP</p>-->
<!--					<p class="album-author">Inn-R</p>-->
<!--				</div>-->
<!--				<div class="col-md-3">-->
<!--					<img src="assets/img/7.jpg" class="album-logo">-->
<!---->
<!--					<p class="album-title">Sedative</p>-->
<!--					<p class="album-author">Mr. Cloudy</p>-->
<!--				</div>-->
<!--				<div class="col-md-3">-->
<!--					<img src="assets/img/8.jpg" class="album-logo">-->
<!---->
<!--					<p class="album-title">Pano EP</p>-->
<!--					<p class="album-author">TRP</p>-->
<!--				</div>-->
			</div>
		</div>
		<div id="panel2" class="tab-pane fade">
			<div class="row">
				<div class="col-md-3">
					<img src="assets/img/5.jpg" class="album-logo">
					<p class="album-title">Singularity</p>
					<p class="album-author">Dublicator</p>
				</div>
				<div class="col-md-3">
					<img src="assets/img/6.jpg" class="album-logo">
					<p class="album-title">Leo Triplet EP</p>
					<p class="album-author">Inn-R</p>
				</div>
				<div class="col-md-3">
					<img src="assets/img/7.jpg" class="album-logo">
					<p class="album-title">Sedative</p>
					<p class="album-author">Mr. Cloudy</p>
				</div>
				<div class="col-md-3">
					<img src="assets/img/8.jpg" class="album-logo">
					<p class="album-title">Pano EP</p>
					<p class="album-author">TRP</p>
				</div>
				<div class="col-md-3">
					<img src="assets/img/1.jpg" class="album-logo">
					<p class="album-title">Light Trails</p>
					<p class="album-author">Gradient</p>
				</div>
				<div class="col-md-3">
					<img src="assets/img/2.jpg" class="album-logo">
					<p class="album-title">Rendered Thoughts</p>
					<p class="album-author">Optic</p>
				</div>
				<div class="col-md-3">
					<img src="assets/img/3.jpg" class="album-logo">
					<p class="album-title">Dubism EP </p>
					<p class="album-author">Upwellings</p>
				</div>
				<div class="col-md-3">
					<img src="assets/img/4.jpg" class="album-logo">
					<p class="album-title">Moment To Dub EP</p>
					<p class="album-author">Axs</p>
				</div>
			</div>
		</div>
		<div id="panel3" class="tab-pane fade">
			<h3>Биография</h3>
			<p><?= $user->bio ?></p>
		</div>
	</div>
</div>


</body>
</html>
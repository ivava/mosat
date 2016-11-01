<?php
include ("templates/header.php");
require ("../backend/classes/Music.php");
if (!isset($_SESSION['upload'])) {
	$_SESSION['upload'] = '';
}
?>
	<div class="container text-center">
	<p><a class="btn btn-primary btn-lg download-music" role="button">Загрузить с компьютера</a></p>
	<p><a class="btn btn-primary btn-lg download-music" role="button">Загрузить из vk.com</a></p>

	<p><a class="btn btn-primary btn-lg download-rel" role="button">Добавить релиз</a></p>

		<?php
		if ($_SESSION['upload'] != 'upload') {
			?>

			<form action="../backend/upload.php" method="post" enctype="multipart/form-data" id="downloadMusic">
				<input type="hidden" name="MAX_FILE_SIZE" value="160000000">
				<input type="file" value="Загрузить с компьютера" class="btn btn-primary btn-lg download-music"
					   name="music_file">
				<!--			<input type="file" value="Загрузить с компьютера" class="btn btn-primary btn-lg download-music" name="music_thumb">-->
				<!--			<input type="text" value="music_name">-->
				<input type="submit" value="dow">
			</form>

			<?php
		}
			?>

			<form action="../backend/upload_thumb.php" method="post" enctype="multipart/form-data" id="downloadMusic">
				<input type="hidden" name="MAX_FILE_SIZE" value="160000000">
				<input type="file" value="Загрузить с компьютера" class="btn btn-primary btn-lg download-music"
					   name="music_thumb">
				<input type="submit" value="dow">
			</form>
			<?php
			if (isset($_SESSION['music_id'])) {
				$music = new Music();
				$music->setParamert($_SESSION['music_id'], $_SESSION['music_path'], $_SESSION['music_title'], $_SESSION['music_user_id']);
				?>
				<div class="audio_item">
					<div class="music_thumb">
						<img src="
<?php
						echo $_SESSION['music_thumb'];
						?>
"
					</div>
					<audio controls>
						<source src="
					<?php
						echo $music->path;
						?>

" type="audio/mpeg">


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
				<?php

		}
		?>
		<?php
		if ($_SESSION['upload'] == 'upload_thumb') {


			?>
			<form action="../backend/upload.php" method="get">
				<input type="hidden" name="done"/>
				<input type="submit" value="Готово">
			</form>

			<?php

		}
		echo print_r($_SESSION);
		?>
	</div>
	<script src="js/script.js"></script>
</body>
</html>
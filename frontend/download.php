<?php
include ("templates/header.php");
require ("../backend/classes/Music.php");
?>
	<div class="container text-center">
	<p><a class="btn btn-primary btn-lg download-music" role="button">Загрузить с компьютера</a></p>
	<p><a class="btn btn-primary btn-lg download-music" role="button">Загрузить из vk.com</a></p>

	<p><a class="btn btn-primary btn-lg download-rel" role="button">Добавить релиз</a></p>
		<form action="../backend/upload.php" method="post" enctype="multipart/form-data" id="downloadMusic">
			<input type="hidden" name="MAX_FILE_SIZE" value="160000000">
			<input type="file" value="Загрузить с компьютера" class="btn btn-primary btn-lg download-music" name="music_file">
			<!--			<input type="file" value="Загрузить с компьютера" class="btn btn-primary btn-lg download-music" name="music_thumb">-->
			<!--			<input type="text" value="music_name">-->
			<input type="submit" value="dow">
		</form>

		<?php

			?>

			<form action="../backend/upload.php" method="post" enctype="multipart/form-data" id="downloadMusic">
				<input type="hidden" name="MAX_FILE_SIZE" value="160000000">
				<input type="file" value="Загрузить с компьютера" class="btn btn-primary btn-lg download-music"
					   name="music_thumb">
				<input type="submit" value="dow">
			</form>
			<?php
		?>

		<?php
		if (isset($_SESSION['music_id'])) {
			$music = new Music();
			$music->setParamert($_SESSION['music_id'], $_SESSION['music_path'], $_SESSION['music_title'], $_SESSION['music_user_id'],
				$_SESSION['music_thumb']);
			?>
			<div class="audio_item">
				<div class="music_thumb">
					<img src="
<?php
					echo $music->thumb;
					?>
"
				</div>
				<audio controls>
					<source src="
					<?php
					echo $music->path;
					?>

" type="audio/mpeg">


					   ></audio>
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
	</div>
	<script src="js/script.js"></script>
</body>
</html>
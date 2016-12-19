<?php
include ("templates/header.php");
require ("../backend/classes/Music.php");
if (!isset($_SESSION['upload'])) {
	$_SESSION['upload'] = '';
}
$_SESSION['music_id'] = '';
?>
	<div class="container text-center">
        <?php
		if ($_SESSION['upload'] != 'upload') {
			?>

			<form action="../backend/upload.php" method="post" enctype="multipart/form-data" id="downloadMusic">
				<input type="hidden" name="MAX_FILE_SIZE" value="160000000">
                <div class="file_upload">
                    <button type="button" class="btn btn-primary btn-lg ">Загрузить с компьютера</button>
                    <div>Файл не выбран</div>
                    <input type="file" name="music_file" required>
                </div>
                <input type="submit" value="dow">
			</form>

			<?php
		}
			?>


<!--			--><?php
//			if (isset($_SESSION['music_id'])) {
//				$music = new Music();
//				$music->setParamert($_SESSION['music_id'], $_SESSION['music_path'], $_SESSION['music_title'], $_SESSION['music_user_id']);
//				?>
<!--				<div class="audio_item">-->
<!--					<audio controls>-->
<!--						<source src="-->
<!--					--><?php
//						echo $music->path;
//						?>
<!---->
<!--" type="audio/mpeg">-->
<!---->
<!---->
<!--						>-->
<!--					</audio>-->
<!--				</div>-->
<!--				<div class="music_title">-->
<!--				<span>-->
<!--					--><?php
//					echo $music->title;
//					?>
<!--				</span>-->
<!--				</div>-->
<!--				--><?php
//
//		}
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
        <p><a href="http://vk.com" class="btn btn-primary btn-lg download-music" role="button" target="_blank">Загрузить из vk.com</a></p>

        <p><a href="#" class="btn btn-primary btn-lg download-rel" role="button">Добавить релиз</a></p>
	</div>
	<script src="js/script.js"></script>
</body>
</html>
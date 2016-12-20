<?php
include ("templates/header.php");
require ("../backend/classes/Music.php");
if (!isset($_SESSION['upload'])) {
	$_SESSION['upload'] = '';
	$_SESSION['show_thumb'] = '';
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
                    <button id="down_to_pc" type="button" class="btn btn-primary btn-lg">Загрузить с компьютера</button>
                    <div>Файл не выбран</div>
                    <input id="mytits" type="file" name="music_file" required>
                </div>
                <input class="down_btn_text done_pc" type="submit" value="Загрузить выбранный файл">
			</form>
            <script>
                $(document).ready(function () {
                    $("#down_to_pc").click(function(event) {
                        $(".done_pc").show();
                        event.preventDefault();
                    })
                    setInterval(function () {
                        if (!$("#mytits").val()) {
                            $(".done_pc").hide();
                        }
                        else {
                            $(".done_pc").show();
                        }
                    }, 500)

                })

            </script>
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
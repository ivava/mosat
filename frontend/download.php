<?php
include ("templates/header.php");
require ("../backend/classes/Music.php");
if (!isset($_SESSION['upload'])) {
	$_SESSION['upload'] = '';
	$_SESSION['show_thumb'] = '';
}
$_SESSION['music_id'] = '';
?>
<div class="progress progress-striped active">
    <div class="progress-bar" style="width: 0%;">
    </div>
</div>
	<div class="container text-center bounceInLeft animated">
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
            <input class="down_btn_text done_pc lightSpeedIn animated" type="submit" value="Загрузить выбранный файл">
        </form>
        <?php
		    }
		?>
        <p><a href="http://vk.com" class="btn btn-primary btn-lg download-music" role="button" target="_blank">Загрузить из vk.com</a></p>
        <p><a href="#" class="btn btn-primary btn-lg download-rel" role="button">Добавить релиз</a></p>
	</div>
	<script src="js/script.js"></script>
    <script src="js/click.js"></script>
</body>
</html>
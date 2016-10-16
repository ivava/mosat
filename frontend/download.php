<?php
include ("templates/header.php");
?>
	<div class="container text-center">
	<p><a class="btn btn-primary btn-lg download-music" role="button">Загрузить с компьютера</a></p>
	<p><a class="btn btn-primary btn-lg download-music" role="button">Загрузить из vk.com</a></p>

	<p><a class="btn btn-primary btn-lg download-rel" role="button">Добавить релиз</a></p>
		<form action="../backend/upload.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="160000000">
			<input type="file" value="Загрузить с компьютера" class="btn btn-primary btn-lg download-music" name="music_file">
			<input type="submit" value="dow">
		</form>
	</div>
	
</body>
</html>
<?php
include ('templates/header.php');
require ('../backend/classes/Music.php');
//require ('../backend/config.php');

$music = Music::getMusicById($_SESSION['music_id']);
?>
<form action="../backend/editAudio.php" method="post">
    <input type="text" name="music_title" placeholder="Название"/>
    <input type="text" name="music_author" placeholder="Автор" />
    <input type="submit" value="Сохранить"/>
</form>

<form action="../backend/upload_thumb.php" method="post" enctype="multipart/form-data" id="downloadMusic">
    <input type="hidden" name="MAX_FILE_SIZE" value="160000000">
    <input type="file" value="Загрузить с компьютера" class="btn btn-primary btn-lg download-music"
           name="music_thumb">
    <input type="submit" value="dow">
    <div id="cropProgress"></div>
    <span class="min_val"></span>
    <span class="max_val"></span>
</form>

<?=$music->title?> <br />
<?=$music->getMusicAuthor()?>
<?php if (isset($music->thumb)) { ?>
    <img src="<?=$music->thumb?>" />
<?php } ?>
<script src="js/cropMusic/range.js"></script>
<?php //print_r($_SESSION)?>
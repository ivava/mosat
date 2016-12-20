<?php
include ('templates/header.php');
require ('../backend/classes/Music.php');
//require ('../backend/config.php');

$music = Music::getMusicById($_SESSION['music_id']);
?>
<div class="progress progress-striped active">
    <div class="progress-bar" style="width: 100%;">
    </div>
</div>
<div class="container text-center">
    <div class="row">
        <h1 class="blue_text">Готово!</h1>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 done_mosat">
            <div class="well">
            <img src="<?=$music->getMusicThumb()?>" /> <br>

                <p>Название: <?=$music->title?> </p><br />
                <p>Автор: <?=$music->getMusicAuthor()?> </p>
            </div>
            <a class="btn btn-primary btn-lg btn_done" href=<?='mosat.php?id=' . $music->id?>>Перейти к мосату</a>
        </div>
    </div>
</div>



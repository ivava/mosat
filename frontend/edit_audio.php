<?php
include ('templates/header.php');
require ('../backend/classes/Music.php');
//require ('../backend/config.php');

$music = Music::getMusicById($_SESSION['music_id']);
?>
<div class="progress progress-striped active">
    <div class="progress-bar" style="width: 33%;">
    </div>
</div>
<div id="animation" class="container create_new_mosat bounceInLeft animated">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="blue_text">Информация о мосате</h1>
            <form id="save_name" action="../backend/editAudio.php" method="post">
                <input class="create_item" type="text" name="music_title" maxlength="18" placeholder="Введите название"/><br>
                <input class="create_item" type="text" name="music_author" maxlength="18" placeholder="Укажите автора" /><br>
                <input class="br_button btn btn-primary btn-lg save_save" type="submit" value="Сохранить"/>
            </form>

            <?php

            if ($_SESSION['show_thumb'] == 'show') {
                ?>
                <div class="well">
                <p>Название: <?=$music->title?> </p><br />
                <p>Автор: <?=$music->getMusicAuthor()?> </p>
                </div>
                <?php
            }
            ?>





            <script src="js/cropMusic/range.js"></script>
            <?php //print_r($_SESSION)?>
        </div>
    </div>
</div>
<script>

    $(".container").hover(function () {
            $("#animation").slideDown('slow');
        })



</script>




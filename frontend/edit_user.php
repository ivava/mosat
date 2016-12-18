<?php
include ("templates/header.php");
//require ("../backend/classes/User.php");
require ("../backend/classes/Music.php");
//require ("../backend/config.php");
$user = User::getUserByUsername($_SESSION['session_username']);

$musicList = $user->getMusicList();
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
                    <h3 class="username">
                        <form method="post" id="editFullName" action="../backend/editProfile.php">
                            <input name="full_name full_name_edit" type="text" value="<?php echo $user->fullName ?>" />
                            <input class="btn btn-primary btn-lg user-subscribe edit_name" type="submit" value="Сохранить"/>
                    </h3>

                    <p class="userlogin">@
                        <?php
                        echo $user->login;
                        ?></p>

                    </form>
                    <form action="../backend/setAvatar.php" method="post" enctype="multipart/form-data">
                        <p>Загрузите новый аватар<br>в формате .jpg .jpeg .JPG</p>
                        <input type="hidden" name="MAX_FILE_SIZE" value="160000000">
                        <input type="file" value="Загрузить" name="avatar">
                        <input class="btn btn-primary btn-lg user-subscribe save_avatar" type="submit" value="Сохранить аватар">
                    </form>
                </div>
            </div>

        </div>

    </div>

    <div class="tab-content">
        <div id="panel3" class="tab-pane fade in active">
            <h3>Изменить биографию</h3>
            <p>
            <form action="../backend/editProfile.php" method="post" id="editBio">
                <textarea name="bio" id="" cols="95" rows="10">
                    <?=$user->bio?>
                </textarea> <br>
                <input class="btn btn-primary btn-lg user-subscribe save_bio" type="submit" value="Сохранить биографию" />
            </form>
    </p>
        </div>
    </div>
</div>


</body>
</html>
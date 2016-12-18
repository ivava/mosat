<?php
include ("templates/header.php");
require ("../backend/classes/User.php");
require ("../backend/classes/Music.php");
require ("../backend/config.php");
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
                            <input name="full_name" type="text" value="<?php echo $user->fullName ?>" />
                    </h3>
                    <p class="userlogin">@
                        <?php
                        echo $user->login;
                        ?></p>
                    <p><input class="btn btn-primary btn-lg user-subscribe" type="submit" value="Сохранить"/></p>
                    </form>
                    <form action="../backend/setAvatar.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="160000000">
                        <input type="file" value="Загрузить" name="avatar">
                        <input type="submit" value="1">
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><span class="user-stats"><span class="number">2</span><br>Мосата</span></div>
                <div class="col-md-4"><span class="user-stats"><span class="number">3,1К</span><br>Подписчиков</span></div>
                <div class="col-md-4"><span class="user-stats"><span class="number">17</span><br>Подписок</span></div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs user-info">
        <li class="active"><a data-toggle="tab" href="#panel1">Мосаты</a></li>
        <li><a data-toggle="tab" href="#panel2">Понравившиеся</a></li>
        <li><a data-toggle="tab" href="#panel3">Биография</a></li>
    </ul>
    <div class="tab-content">
        <div id="panel1" class="tab-pane fade in active">
            <div class="row">
                <?php
                $musicListCount = count($musicList);
                for ($i = 0; $i < $musicListCount; $i++) {
                    if ($i > 8) break;
                    ?>
                    <div class="col-md-3">
                        <img src="
<?php
                        echo $musicList[$i]['thumb'];
                        ?>
					" class="album-logo">
                        <p class="album-title"><?php
                            echo $musicList[$i]['title'];
                            ?></p>
                        <p class="album-author">AURTOR</p>
                    </div>
                    <?php
                }
                ?>
                <!--				<div class="col-md-3">-->
                <!--					<img src="assets/img/2.jpg" class="album-logo">-->
                <!---->
                <!--					<p class="album-title">-->
                <!--					</p>-->
                <!--					<p class="album-author">Optic</p>-->
                <!--				</div>-->
                <!--				<div class="col-md-3">-->
                <!--					<img src="assets/img/3.jpg" class="album-logo">-->
                <!---->
                <!--					<p class="album-title">Dubism EP </p>-->
                <!--					<p class="album-author">Upwellings</p>-->
                <!--				</div>-->
                <!--				<div class="col-md-3">-->
                <!--					<img src="assets/img/4.jpg" class="album-logo">-->
                <!---->
                <!--					<p class="album-title">Moment To Dub EP</p>-->
                <!--					<p class="album-author">Axs</p>-->
                <!--				</div>-->
                <!--				<div class="col-md-3">-->
                <!--					<img src="assets/img/5.jpg" class="album-logo">-->
                <!---->
                <!--					<p class="album-title">Singularity</p>-->
                <!--					<p class="album-author">Dublicator</p>-->
                <!--				</div>-->
                <!--				<div class="col-md-3">-->
                <!--					<img src="assets/img/6.jpg" class="album-logo">-->
                <!---->
                <!--					<p class="album-title">Leo Triplet EP</p>-->
                <!--					<p class="album-author">Inn-R</p>-->
                <!--				</div>-->
                <!--				<div class="col-md-3">-->
                <!--					<img src="assets/img/7.jpg" class="album-logo">-->
                <!---->
                <!--					<p class="album-title">Sedative</p>-->
                <!--					<p class="album-author">Mr. Cloudy</p>-->
                <!--				</div>-->
                <!--				<div class="col-md-3">-->
                <!--					<img src="assets/img/8.jpg" class="album-logo">-->
                <!---->
                <!--					<p class="album-title">Pano EP</p>-->
                <!--					<p class="album-author">TRP</p>-->
                <!--				</div>-->
            </div>
        </div>
        <div id="panel2" class="tab-pane fade">
            <div class="row">
                <div class="col-md-3">
                    <img src="assets/img/5.jpg" class="album-logo">
                    <p class="album-title">Singularity</p>
                    <p class="album-author">Dublicator</p>
                </div>
                <div class="col-md-3">
                    <img src="assets/img/6.jpg" class="album-logo">
                    <p class="album-title">Leo Triplet EP</p>
                    <p class="album-author">Inn-R</p>
                </div>
                <div class="col-md-3">
                    <img src="assets/img/7.jpg" class="album-logo">
                    <p class="album-title">Sedative</p>
                    <p class="album-author">Mr. Cloudy</p>
                </div>
                <div class="col-md-3">
                    <img src="assets/img/8.jpg" class="album-logo">
                    <p class="album-title">Pano EP</p>
                    <p class="album-author">TRP</p>
                </div>
                <div class="col-md-3">
                    <img src="assets/img/1.jpg" class="album-logo">
                    <p class="album-title">Light Trails</p>
                    <p class="album-author">Gradient</p>
                </div>
                <div class="col-md-3">
                    <img src="assets/img/2.jpg" class="album-logo">
                    <p class="album-title">Rendered Thoughts</p>
                    <p class="album-author">Optic</p>
                </div>
                <div class="col-md-3">
                    <img src="assets/img/3.jpg" class="album-logo">
                    <p class="album-title">Dubism EP </p>
                    <p class="album-author">Upwellings</p>
                </div>
                <div class="col-md-3">
                    <img src="assets/img/4.jpg" class="album-logo">
                    <p class="album-title">Moment To Dub EP</p>
                    <p class="album-author">Axs</p>
                </div>
            </div>
        </div>
        <div id="panel3" class="tab-pane fade">
            <h3>Биография</h3>
            <p>
            <form action="../backend/editProfile.php" method="post" id="editBio">
                <textarea name="bio" id="" cols="30" rows="10">
                    <?=$user->bio?>
                </textarea>
                <input type="submit" value="Сохранить" />
            </form>
    </p>
        </div>
    </div>
</div>


</body>
</html>
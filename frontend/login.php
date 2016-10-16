<?php
include ("templates/header.php");
?>
<?php if (isset($_SESSION['session_username'])) {
    ?>
<h2>Вы Вошли как <?php echo $_SESSION['session_username'] ?></h2>
<?php } else { ?>
    <?php
    if ($_SESSION['error_log'] == 1) {
        echo "<p class='error_log'>Неправильный логин или пароль</p>";
        $_SESSION['error_log'] = null;
    }
    ?>
<form method="post" action="../backend/login.php" class="base_form">
    <input type="text" name="username" placeholder="log">
    <input type="password" name="password" placeholder="pass">
    <input type="hidden" name="login">
    <input type="submit" value="Войти">
</form>
<?php } ?>

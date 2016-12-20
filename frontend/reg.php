<?php
include ("templates/header.php");
?>

<form action="../backend/register.php" method="post" class="base_form reg_form">
<input type="text" name="username" required placeholder="Логин">
<input type="text" name="full_name" required placeholder="Отображаемое имя">
<input type="text" name="email" required placeholder="Email">
<input type="password" name="password" required placeholder="Пароль">
<input type="hidden" name="register">
<input type="submit" name="submit" value="Регистрация">
</form>


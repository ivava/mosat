<?php
include ("templates/header.php");
?>

<form action="../backend/register.php" method="post">
<input type="text" name="username" required placeholder="имя">
<input type="text" name="full_name" required placeholder="имя">
<input type="text" name="email" required placeholder="email">
<input type="password" name="password" required placeholder="password">
<input type="hidden" name="register">
<input type="submit" name="submit" value="Регистрация">
</form>


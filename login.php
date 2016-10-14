<?php 
include ("templates/header.php"); 
?> 
<?php if (!isset($_SESSION['session_username'])) { 
?> 
<h2>Вы Вошли как <?php echo $_SESSION['session_username'] ?></h2> 
<?php } else { ?> 
<form method="post" action="../backend/login.php"> 
<input type="text" name="username" placeholder="log"> 
<input type="password" name="password" placeholder="pass"> 
<input type="hidden" name="login"> 
</form> 
<?php } ?>
вмвыыыыыыыыыыыыыыыыыыыыыыыыыыы
<?php 
include ("templates/header.php"); 
?> 
<?php if (isset($_SESSION['session_username'])) { 
?> 
<h2>Вы Вошли как <?php echo $_SESSION['session_username'] ?></h2> 
<?php } else { ?> 
<form method="post" action="../backend/login.php"> 
<input type="text" name="username" placeholder="log"> 
<input type="password" name="password" placeholder="pass"> 
<input type="hidden" name="login"> 
</form> 
<?php } ?>
<?php
require ('config.php');
session_start();
$user = User::getUserByUsername($_SESSION['session_username']);
if (isset($_POST['full_name'])) {
 $user->fullName = $_POST['full_name'];
  $user->updateFullName($user->fullName);
}
if (isset($_POST['bio'])) {
    $user->insertBio($_POST['bio']);
}
header("Location: ../frontend/user.php");

?>
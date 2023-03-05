﻿<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('config.php');
session_start();
/*page de connexion */
if (isset($_POST['username'])){
  $username = $_REQUEST['username'];
  $username = mysqli_real_escape_string($conn, $username);
  $password = $_REQUEST['password'];
  $password = mysqli_real_escape_string($conn, $password);
  $role = $_REQUEST['role'];
  $role = mysqli_real_escape_string($conn, $role);
  $query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."' and role='$role' ";
  $result = mysqli_query($conn,$query) or die(mysql_error());
  $rows = mysqli_num_rows($result);
  if($rows==1){
      $_SESSION['username'] = $username;
      header("Location: index.php");
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect .";
  }

}

?>
<form class="box" action="" method="post" name="login">

<h1 class="box-title">Connexion</h1>
<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
<input type="text" class="box-input" name="role" placeholder="role">
<input type="password" class="box-input" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>
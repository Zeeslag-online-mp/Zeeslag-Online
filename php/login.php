<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 26-8-2019
 * Time: 11:26
 */

?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="../site.webmanifest">
  <link rel="apple-touch-icon" href="../icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/main.css">
</head>

<body>

<main>
<div class="login">
  <div class="container">
    <h2>Login Zeeslag</h2>
    <form action="logincontroller.php" method="post">
      <input type="hidden" name="type" value="login">

      <label for="email"><b class="login-email">Email</b></label>
      <input class="login_field" type="text" placeholder="Enter Email or Username" name="email" required>

      <label for="psw"><b class="login-password">Password</b></label>
      <input class="login_field" type="password" placeholder="Enter Password" name="password" required>
      
      <input type="submit" value="Login" class="login-a">
    </form>
  </div>
</div>
</main>

</body>

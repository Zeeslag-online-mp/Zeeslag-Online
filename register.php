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

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>

<main>
  <div class="register">
    <div class="container">
      <div class="background-register">
        <h2>Register Zeeslag</h2>
        <nav class="navigatie.register">
          <a href="index.html">Home</a>
          <a href="login.php">Login</a>
        </nav>
          <form action="logincontroller.php" method="post">
            <input type="hidden" name="type" value="register">

            <label for="email"><b class="register-email">Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email">

            <label for="username"><b class="register-username">Username</b></label>
            <input type="text" placeholder="Enter username" name="username">

            <label for="psw"><b class="register-password">Password</b></label>
            <input type="password" placeholder="Enter Password" name="password">

            <label for="psw"><b class="register-password-reapeat">Voer opnieuw Password in</b></label>
            <input type="password" placeholder="Enter password again" name="passwordconfirm">

            <button class="registerbutton" type="submit" value="Create new contact">Register Account</button>
        </form>
      </div>
    </div>
  </div>
</main>

</body>

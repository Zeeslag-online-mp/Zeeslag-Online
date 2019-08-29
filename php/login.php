<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 26-8-2019
 * Time: 11:26
 */

require 'config.php';

if( isset($_GET['msg'])){
  $msg = $_GET['msg'];
  echo '<script>alert("'.$msg.'")</script>';
}

require 'header.php';

?>

<body>

<main>
<div class="login">
  <div class="container">
    <h2>Login Zeeslag</h2>
    <form action="logincontroller.php" method="post">
      <input type="hidden" name="type" value="login">

      <label for="email"><b class="login-email">Email</b></label>
      <input class="login_field" type="text" placeholder="Enter Email or Username" name="email"required>

      <label for="psw"><b class="login-password">Password</b></label>
      <input class="login_field" type="password" placeholder="Enter Password" name="password" required>
      
      <input type="submit" value="Login" class="login-a">
    </form>
  </div>
</div>
</main>

</body>

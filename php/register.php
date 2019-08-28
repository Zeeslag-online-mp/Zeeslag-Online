<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 26-8-2019
 * Time: 11:26
 */

require 'config.php';

if( isset($_GET['msg'])){
  echo $_GET['msg'];
}

require 'header.php';

?>

<main>
  <div class="register">
    <div class="container">
      <div class="background-register">
        <h2>Register Zeeslag</h2>
          <form action="logincontroller.php" method="post">
            <input type="hidden" name="type" value="register">

            <label for="email"><b class="register-email">Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email">

            <label for="username"><b class="register-username">Username</b></label>
            <input type="text" placeholder="Enter username" name="username" id="username">

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

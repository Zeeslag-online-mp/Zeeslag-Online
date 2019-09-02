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
    <div class="two-side-page">
      <div class="left-side-page">
        <h2>Inloggen</h2>
        <form action="logincontroller.php" method="post">
          <input type="hidden" name="type" value="login">

          <label for="email"><b class="login-email">Gebruikersnaam/email</b></label>
          <input class="login_field" type="text" placeholder="Typ uw gebruikersnaam of email" name="email" required>

          <label for="psw"><b class="login-password">Wachtwoord</b></label>
          <input class="login_field" type="password" placeholder="Typ uw wachtwoord" name="password" required>
          
          <button type="submit" class="button submit-button" value="login" class="login-a">Login</button>
        </form>
      </div>
      <div class="right-side-page">
        <img class="battleship-img" src="../img/battleship-blueprint-2.jpg" alt="Aanvalsschip foto"/>
      </div>
    </div>
  </div>
</div>
</main>

</body>

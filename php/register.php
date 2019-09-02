<?php

require 'config.php';
require 'header.php';

?>

<main>
  <div class="register">
    <div class="container">
      <div class="background-register">
        <h2>Registreren</h2>
          <div class="two-side-page">
            <div class="left-side-page">
              <form class="form" action="logincontroller.php" method="post">
                <input type="hidden" name="type" value="register">

                <label for="username"><b class="register-username">Gebruikersnaam</b></label>
                <input type="text" placeholder="Typ hier uw gebruikersnaam" name="username" id="username" required>

                <label for="email"><b class="register-email">Email</b></label>
                <input type="email" placeholder="Typ hier uw email" name="email" id="email" required>

                <label for="psw"><b class="register-password">Wachtwoord</b></label>
                <input type="password" placeholder="Typ hier uw wachtwoord" name="password" required>

                <label for="psw"><b class="register-password-reapeat">Voer opnieuw wachtwoord in</b></label>
                <input type="password" placeholder="Typ hier uw wachtwoord" name="passwordconfirm" required>

                <button class="button submit-button" type="submit" value="register">Maak aan</button>
            </form>
          </div>
          <div class="right-side-page">
            <img class="battleship-img" src="../img/battleship-blueprint-1.jpg" alt="Aanvalsschip foto"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

</body>

<?php require 'footer.php'; ?>

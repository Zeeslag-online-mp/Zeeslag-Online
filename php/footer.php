<!-- Use ( require 'footer.php' ) in document where you need the footer -->

<footer>
  <div class="footer-background">
    <div class="container">
      <div class="footer-content">

        <div>
          <p>© <?php echo date("Y"); ?></p>
          <p>Developed by us!</p>
        </div>

        <div>
          <h4>Links</h4>
          <ul class="footer-link-list">
            <li><a href="">Home</a></li>
            <li><a href="">Info</a></li>
            <li><a href="">Over Ons</a></li>
            <li><a href="">Doneren</a></li>
            <li><a href="https://affortech.nl/portfolio/" target="_blank">Portfolio</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
</footer>

<?php

// Check if there is a message to display
if( isset($_GET['msg'])){
  $msg = $_GET['msg'];
  echo '<script>alert("'.$msg.'")</script>';
}
// Checks if there is a message to display without using GET request
else if (isset($_SESSION['message'])) {

  $msg = $_SESSION['message'];
  echo '<script>alert("'.$msg.'")</script>';
  unset($_SESSION['message']);
}

?>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script>
  
  // DOESNT WORK YET!!!  

  // Sends request to the friends controller which checks the database for friend requests
  /*function getInvite() {

    $.ajax({
        //url: location.host + "/php/friends-controller.php?fetch-invites=fetch-invites", // Goes to script which sends request to database
        url: "friends-controller.php?fetch-invites=fetch-invites",
        contentType: 'application/json; charset=utf-8',
        type: "POST", // Request type
        success: function(result) { // When request to script is succesful
          var invites = JSON.parse(result); // Converts JSON string 'result' to object
         
          for (i = 0; i < invites.length; i++) { // Foreach invite inside array

            var request = invites[i]; 

            // AJAX request to friends controller to delete invite
            $.ajax({
              //url: location.host + "/php/friends-controller.php?remove-invite=remove-invite",
              url: "friends-controller.php?remove-invite=remove-invite",
              type: "POST"
            });

            // When true send user to the game, else stay on the same page
            if (confirm(request.username)) {
              //window.location.replace = location.host + "/php/game.php?game=";
              window.location.replace = "game.php?game=";
            }

          }

        }
      });
  }

  getInvite(); // Runs function on page load

  // Runs function every 5 seconds to check for friend requests
  setInterval( function() {
    getInvite()
  }, 5000);*/

  </script>
  <script src="js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="../js/plugins.js"></script>
  <script src="../js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set','transport','beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
</body>

</html>

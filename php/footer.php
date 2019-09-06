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

?>

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

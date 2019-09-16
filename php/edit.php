<?php
require 'config.php';
$id = $_GET['id'];

$sql = "SELECT * FROM teams WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare ->execute([
  ':id' => $id
]);

$fifa = $prepare->fetch(PDO::FETCH_ASSOC);

require "header.php";
?>
<form <?="action='teamcontroller.php?id={$id}'"?> method='post'>
  <input type='hidden' name='type' value='edit'>
  <div class='fill-in'>
    <label for='team'>team naam:</label>
    <input type='text' name='team' id='team' <?="value='{$fifa['team']}'"?>>
  </div>
  <div class="form-btn">
    <input type='submit' value='Submit'>
  </div>

  <?php
  if (isset($_GET['msg'])){
    echo "<div class='error-box'> <p class='errorMSG'>error:</p> <p class='errorMSG'>{$_GET['msg']}</p> </div>";
  }
  ?>
</form>

<?php
require "footer.php";
?>

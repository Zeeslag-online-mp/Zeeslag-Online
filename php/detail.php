<?php
require 'config.php';

$id = $_GET['userId'];
$sql = "SELECT * FROM users WHERE  id = :id";
$prepare = $db->prepare($sql);
$prepare ->execute([
  ':id' => $id
]);


$username = $prepare->fetch(PDO::FETCH_ASSOC);

$userDecode = html_entity_decode($username['username']);

require "header.php";

  echo"<p>Welkom op de pagina van {$userDecode}!</p>";

require "footer.php";
?>

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
?>
<main>
  <style>
    table, th, td {
      border: 1px solid black;
      list-style: none;
      text-align: center;
    }
  </style>
       <?php

          echo "<p>Hier zie {$userDecode} statistieken!</p>'";

            $scoreInfos = $prepare->fetchAll(PDO::FETCH_ASSOC);

            $sql = "SELECT * FROM score WHERE user_Id = :id";
            $prepare = $db->prepare($sql);
            $prepare->execute([
              ':id' => $_SESSION['id']
            ]);

            $statistics = $prepare->fetch(PDO::FETCH_ASSOC);

        ?>

       <ul>
          <table style="width:100%">
            <tr>
              <th>Winnaar </th>
              <th>Verliezer</th>
              <th>Punten</th>
              <th>Totaal gespeeld</th>

            </tr>
            <tr>
              <td>
                <?php
                echo '<li><a style="color: #0f0e0d" href="" onclick="">';
                echo $statistics['win'];
                ?>
              </td>
              <td>
                <?php
                echo '<li><a style="color: #0f0e0d" href="" onclick="">';
                echo $statistics['lose'];
                ?>
              </td>
              <td>
                <?php
                echo '<li><a style="color: #0f0e0d" href="" onclick="">';
                echo $statistics['points'];

                ?>
              </td>
              <td>
                <?php
                echo '<li><a style="color: #0f0e0d" href="" onclick="">';
                echo $statistics['totaal'];
                ?>
              </td>
            </tr>
          </table>
      </ul>
</main>
<?php
require "footer.php";
?>

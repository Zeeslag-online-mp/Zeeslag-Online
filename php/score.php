<?php require 'header.php'?>

<main>
  <style>
    table, th, td {
      border: 1px solid black;
      list-style: none;
      text-align: center;
    }
  </style>
  <div class="container">

    <?php

    $id = $_SESSION['id']; // ID of user that is logged in

    echo "<h2>Hallo ".$_SESSION['username'].",</h2>";


    ?>
    <p>Hier zie je je statistieken!</p>
    <ul>
      <?php
      $sql = "SELECT s.points, s.win, s.lose, s.totaal, `u`.`username`, s.`user_id` FROM score AS `s` inner join `users` AS `u` on `u`.`id`=`s`.`user_id` ORDER BY points DESC;";

      $prepare = $db->prepare($sql);
      $prepare->execute([
        ':userId' => $_SESSION['id']
      ]);

      $scoreInfos = $prepare->fetchAll(PDO::FETCH_ASSOC);

      $sql = "SELECT * FROM score WHERE user_id = :id";
      $prepare = $db->prepare($sql);
      $prepare->execute([
        ':id' => $_SESSION['id']
      ]);

      $statistics = $prepare->fetch(PDO::FETCH_ASSOC);
      ?>
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
    <p>Hoe sta je in de race!</p>
    <table style="width:100%">
      <tr>
        <th>Spelers</th>

      </tr>
      <tr>
        <td>
          <?php
          foreach ($scoreInfos as $score) {
            echo '<li><a style="color: #0f0e0d" href="detail.php?userId=' . $score['user_id'] . '">';
            echo $score ['username'], " heeft " ,$score['points']," ", "punten!";
          }
          ?>
        </td>
      </tr>
    </table>

  </div>
</main>
<?php require 'footer.php'?>


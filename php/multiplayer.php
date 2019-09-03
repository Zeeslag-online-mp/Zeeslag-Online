<?php

session_start();

require 'config.php';

echo $_SESSION['username'];

$sql = "INSERT INTO `games` ('player_1_id', 'player_2_id', 'gamefase') VALUES (1, 2, 0);";

<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 26-8-2019
 * Time: 11:07
 */



$dbName = 'zeeslag';
$dbHost = 'localhost';
$dbPass = '';
$dbUser = 'root';

$db = new PDO(
  "mysql:host=$dbHost;dbname=$dbName",
  $dbUser,
  $dbPass
);

//error opvangen.
$db ->setAttribute(
  PDO::ATTR_ERRMODE,
  PDO::ERRMODE_EXCEPTION
);

if(session_id() == '' || !isset($_SESSION)){
  session_start();
}

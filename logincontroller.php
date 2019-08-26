<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 26-8-2019
 * Time: 11:14
 */

  if($_server['REQUEST_METHODE'] != 'POST'){
    header("index.php");
    exit;
  };

  require 'config.php';

  //login

  if ($_POST ['type'] === 'login'){

    $errormsg = '';

    //haal de date op van form
    $email = $_POST ['email'];
    $username = $_POST ['username'];
    $password = $_POST ['password'];

  }

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

  //register

  if($_POST ['type'] === 'register'){

    //variabel
    $email = $_POST['email'];
    $username= $_POST ['username'];
    $password = $_POST['password'];

    //password hashen
    $passwordhashed = password_hash($password, PASSWORD_DEFAULT);

    //check of de mail echt is of niet
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $message = "This is not a valid mail";
      header("location: register.php?msg=$message");
      exit;
    }
  }

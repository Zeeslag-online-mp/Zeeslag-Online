<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 26-8-2019
 * Time: 11:14
 */

  if($_SERVER['REQUEST_METHOD'] != 'POST'){
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

    //Als mail leeg is
    if ($email = ''){
      $errormsg = "Enter mail";
    }

    // als de username leeg is
    if ($username =''){
      $errormsg = 'Enter your username';
    }

    //als de password leeg is
    if ($password = ''){
      $errormsg = 'Enter your password';
    }

    //als er geen fouten zijn
    if ($errormsg = ''){
      try{

        $st = $db->prepare('SELECT id, email, username, password FROM users WHERE email = :email');
        $st->execute(array(
          'email' => $email
        ));

        // als de mail adderess niet besaat
        if ($email == false){
          $errormsg = "Deze mail adderess bestaat niet!";
        }
        //als de inlog gegevens kloppen voert dit uit.
        else{
          //hier ga die wachtwoord controleren
          if (password_verify($password, $data ['password'])){

            //haalt de email uit de data base
            $_SESSION['email'] = $data ['email'];
            //haalt je id op
            $_SESSION['id'] = $data ['id'];
            //haalt je username op
            $_SESSION['username'] = $data ['username'];

            header("Location: index.php");
            exit();
          }
        }

      }
      //als account niet bestaat
      catch (PDOException $e){
        $errormsg = 'Acoount bestaat niet!';
        header("Location: login.php?msg=$errormsg");
      }
    }

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

    //selecteer uit de data base user waar email en gebruiksnaam staat
    $sqlStatement = "select * from users where email = ".$email." username = ".$username." ";

    $database=$db->prepare($sqlStatement);

    $database->bindParam(":email", $email);

    $database->bindParam(":username", $username);
    //voer die het uit
    $database->execute();

    //gaat checken
    $countmail=$database->rowCount();
    //gaat checkem
    $countuser=$database->rowCount();

    //als de email bestaad krijg je deze bericht
    if ($countmail >0){
      $message = 'Deze email bestaat al';
      echo "<script type='text/javascript'>alert('$message');</script>";

      header("location: register.php?msg=$message");
      exit();
    }

    if ($_POST['password'] != $_POST['passwordconfirm']) {

      $message = "Wachtwoord komt niet overeen!";
      echo "<script type='text/javascript'>alert('$message');</script>";

    }

    //check de username
    if ($countuser >0){
      $message = 'Deze gebruiker bestaat al';
      echo "<script type='text/javascript'>alert('$message');</script>";

      header("location: register.php?msg=$message");
      exit();
    }

    // hier check die of de wachtwoord niet leeg is
    if($_POST['password'] == ""){
      $msg = "Wachtwoord mag niet leeg zijn!";
      header("location: register.php?msg=$msg");

    }
    else{
      //hier check die of de wachtwoorden overeen komen
      if ($_POST['password'] == ['passwordconfirm']){
        $sql = "INSERT INTO users (email, password, username) VALUE :email :password :username";
        $prepare= $db->prepare($sql);
        $prepare->execute([
          ':email' => $email,
          ':password' => $passwordhashed,
          ':username' => $username
        ]);
        $msg = "Account is succesvol aangemaakt!";
        header("location: login.php?msg=$msg");
        exit;
      }
    }
  }

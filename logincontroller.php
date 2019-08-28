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
        $data = $st->fetch(PDO::FETCH_ASSOC);  
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

            header("Location: register.php");
            exit();
          }
          else{
            $errormsg = 'Acoount bestaat niet!';
            header("Location: login.php?msg=$errormsg");
          }
        }
      }
      //als account niet bestaat
      catch (PDOException $e){
        $errormsg = $e->getMessage();
      }
    }

  }

  //register

  if ($_POST['type'] === 'register') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    try {
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }

    if (isset($_POST['submit'])) {

        try {
            $stmt = $conn->prepare('SELECT email FROM users WHERE email = ?');
            $stmt->bindParam(1, $_POST['email']);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        if ($stmt->rowCount() > 0) {
            echo "Uw email bestaat al";
        } else {
            echo "Uw email bestaat nog niet";
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is vereist";
        } else {
            $email = test_input($_POST["email"]);
        }
        try {
          $stmt = $conn->prepare('SELECT username FROM users WHERE username = ?');
          $stmt->bindParam(1, $_POST['username']);
          $stmt->execute();
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

          }
      } catch (PDOException $e) {
          echo 'ERROR: ' . $e->getMessage();
      }

      if ($stmt->rowCount() > 0) {
          echo "Uw username bestaat al";
      } else {
          echo "Uw username bestaat nog niet";
      }
      if (empty($_POST["username"])) {
          $userErr = "Username is vereist";
      } else {
          $user = test_input($_POST["user"]);
      }

    }
   
        if (strlen($password) < 7 || strlen($password) > 16) {
            $errors[] = "Het wachtwoord moet ten minste 7 karakters en maximaal 16 karakters U word na 5 seconden teruggestuurd.";
        }
        if (!preg_match("/\d/", $password)) {
            $errors[] = "Het wachtwoord moet ten minste 1 cijfer Bevatten U word na 5 seconden teruggestuurd.";
        }
        if (!preg_match("/[A-Z]/", $password)) {
            $errors[] = "Het wachtwoord moet een hoofdletter bevatten U word na 5 seconden teruggestuurd.";
        }
        if (!preg_match("/[a-z]/", $password)) {
            $errors[] = "Het wachtwoord moet tenminste 1 kleine letter bevatten U word na 5 seconden teruggestuurd.";
        }

        if ($errors) {
            foreach ($errors as $error) {
                echo $error . "\n";
            }
            header("refresh:5; url=https://jaibreyonlourens.nl/Project-Fifa-PHP/register.php");
    
            die();
        } else {
            header('location: login.php');
        }
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

        $sql = "INSERT INTO users (email, password, username) 
                     VALUES (:email, :password, :username)";
        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':email'         => $email,
            ':password'      => $passwordHash,
            ':username'      => $username
        ]);
  
}
exit;
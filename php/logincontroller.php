  <?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 26-8-2019
 * Time: 11:14
 */

if($_SERVER['REQUEST_METHOD'] != 'POST'){
  header('Location: index.php');
  exit;
};

require 'config.php';

//login

if ( $_POST['type'] === 'login' ) {

  $errMsg = '';

  // Get data from FORM
  $email = $_POST['email'];
  $password = $_POST['password'];

  // als je geen email invult krijg je een error msg met enter een email
  if($email == '')
    $errMsg = 'Enter email';
  //als je geen wachtwoord invult krijg je een melding vul een wachtwoord in
  if($password == '')
    $errMsg = 'Enter password';

  // als er geen error bericht is voer die deze code uit
  if($errMsg == '') {
    try {
      $stmt = $db->prepare('SELECT id, email, password FROM users WHERE email = :email');
      $stmt->execute(array(
        ':email' => $email
      ));
      $data = $stmt->fetch(PDO::FETCH_ASSOC);
      // dit voer die uit als de email niet bestaad
      if($email == false){
        $errMsg = "User $email not found.";
      }
      // als je email goed is voer die deze code uit
      else {
        // hier check die het wachtwoord
        if(password_verify($password, $data['password'])) {

          // daarna haal die je email op uit de database
          $_SESSION['email'] = $data['email'];
          // daarna haal die je id op
          $_SESSION['id'] = $data['id'];

          header("Location: ../index.php");
          exit();
        }
        // als de account niet bestaad krijg je een melding
        else {
          $errMsg = 'Account bestaat niet of wachtwoord is verkeerd.';
          header("Location: login.php?msg=$errMsg");
        }
      }
    }
    catch(PDOException $e) {
      $errMsg = $e->getMessage();
    }
  }


  exit;
}

//register

if($_POST ['type'] === 'register'){

  //variabel
  $email = $_POST['email'];
  $username= $_POST ['username'];
  $password = $_POST['password'];
  $passwordconfirm = $_POST['passwordconfirm'];

  
  //password hashen
  $passwordhashed = password_hash($password, PASSWORD_DEFAULT);

  //check of de mail echt is of niet
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $message = "Dit is geen geldig mail";
    header("location: register.php?msg=$message");
    exit;
  }

  //selecteer email en daarna ga die checken of de mail bestaat via databee
  $sqlStatement = "select * from users where email=:email";

  $database=$db->prepare($sqlStatement);

  $database->bindParam(":email", $email);

  $database->execute();

  //selecteer username en daarna ga die checken of de username bestaat via data base
  $sqlStatement = "select * from users where username=:username";

  $databasea=$db->prepare($sqlStatement);

  $databasea->bindParam(":username", $username);

  $databasea->execute();

  //gaat checken
  $countmail=$database->rowCount();
  //gaat checkem
  $countuser=$databasea->rowCount();

  //als de email bestaat krijg je deze bericht
  if ($countmail >0){
    $message = 'Deze email bestaat al';

    header("location: register.php?msg=$message");
    exit();
  }

  //check de username
  if ($countuser >0){
    $message = 'Deze gebruiker bestaat al';


    header("location: register.php?msg=$message");
    exit();
  }

  if ($_POST['password'] != $passwordconfirm) {

    $message = "Wachtwoord komt niet overeen!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    exit();

  }

  // hier check die of de wachtwoord niet leeg is
  if($_POST['password'] == ""){
    $msg = "Wachtwoord mag niet leeg zijn!";
    header("location: register.php?msg=$msg");

  }
  else{
    //hier check die of de wachtwoorden overeen komen
    if ($password == $passwordconfirm){

      $sql = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
      $prepare = $db->prepare($sql);
      $prepare->execute([
        ':email' => $email,
        ':username' => $username,
        ':password' => $passwordhashed
      ]);
      $msg = "Account is succesvol aangemaakt!";
      header("location: login.php?msg=$msg");
      exit;

    } else {
      $messagefail = "wachtwoorden komen niet overeen!";
      header("location: register.php?msg=$messagefail");
    }
  }
}

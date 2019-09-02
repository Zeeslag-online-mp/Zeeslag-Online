<?php require 'config.php'




?>

<!-- Use ( require 'header.php' ) in document where you need the header -->

<!DOCTYPE html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href=<?php echo 'http://'.$host.'/Zeeslag-Online/site.webmanifest'?>>
  <link rel="apple-touch-icon" href=<?php echo 'http://'.$host.'/Zeeslag-Online/icon.png'?>>
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href=<?php echo 'http://'.$host.'/Zeeslag-Online/css/normalize.css'?>>
  <link rel="stylesheet" href=<?php echo 'http://'.$host.'/Zeeslag-Online/css/main.css'?>>

  <meta name="theme-color" content="#fafafa">
</head>

<body>
  <div class="navbar-item">

  </div>
  
    <header>
        <div class="container">
          <div class="navbar">
          <h1><a class='navbar-item' href=<?php echo 'http://'.$host.'/Zeeslag-Online/index.php'?>> ZEESLAG</a></h1>
                <a class='navbar-item' href=<?php echo 'http://'.$host.'/Zeeslag-Online/index.php'?>> HOME</a>
            <?php if(isset($_SESSION['id'])){
                  echo 
                  " <a class= 'navbar-item' href='php/logout.php'>Uitloggen</a>";
              }else{
                echo " 
                <div class='navbar-items-right'>
                  <p>
                  <div class='navbar-item'>
                    <a href= 'http://'.$host.'/Zeeslag-Online/php/login.php'>LOGIN</a>
                  </div>
                    |
                  <div class='navbar-item'>
                    <a  href= 'http://'.$host.'/Zeeslag-Online/php/register.php'>REGISTER</a>
                	</div>
                    
                  </p>
                </div>";
              }
            
            ?>
           
          </div>
        </div>  
    </header>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

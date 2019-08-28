<?php require 'config.php'?>

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
  <header>
    <div class="navbar">
      <h1><a href=<?php echo 'http://'.$host.'/Zeeslag-Online/index.php'?>>ZEESLAG</a></h1>
      <p><a href=<?php echo 'http://'.$host.'/Zeeslag-Online/index.php'?>>HOME</a></p>
      <p><a href=<?php echo 'http://'.$host.'/Zeeslag-Online/php/login.php'?>>LOGIN</a>  OF  <a href=<?php echo 'http://'.$host.'/php/register.php'?>>MAAK EEN ACCOUNT AAN</a></p>
    </div>   
  </header>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

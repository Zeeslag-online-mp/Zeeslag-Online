<?php require 'header.php'?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    table, th, td {
      border: 3px solid black;
      border-collapse: collapse;
    }
    h1, h2 {
      text-align: center;
    }
    h3 {
      margin-right: 70%;
    }
    .bron{
      color: black;
      font-size: 35px;
    }
  </style>
  <title>Info</title>
</head>
<body>
<div class="container">

<h1>Battleship (game)</h1>
<p>Zeeslag is een bekend spelletje dat oorspronkelijk op papier werd gespeeld. Later bracht MB een spel onder dezelfde titel uit. Het spel kan nu ook online via het internet gespeeld worden.</p>
<h2>Speelwijze</h2>
<p>Zeeslag wordt gespeeld op een veld van 10 x 10 hokjes. Dit veld is langs 1 as genummerd met getallen, en langs 1 as met letters.
  Een hokje wordt derhalve aangeduid met een letter-cijfercombinatie, bijvoorbeeld A1 of B9.
  Iedere speler mag op zijn helft tien schepen plaatsen met een omvang variërend van 2 tot 5 opeenvolgende hokjes.
  Schepen mogen horizontaal of verticaal staan, maar niet diagonaal.
  Het aantal vierkanten voor elk schip wordt bepaald door het type schip.
  De boten raken elkaar niet, ze liggen helemaal vrij van de andere schepen.
  De soorten en aantallen toegestane schepen zijn hetzelfde voor elke speler.</p>
        <table style="width:30%">
          <h3>De meest gebruikte schepen zijn:</h3>
          <tr>
            <th>Aantal schepen</th>
            <th>Scheepstype</th>
            <th>Afmeting in vakjes</th>
          </tr>
          <tr>
            <td>1x</td>
            <td>vliegdekschip</td>
            <td>6</td>
          </tr>
          <tr>
            <td>2x</td>
            <td>slagschip</td>
            <td>4</td>
          </tr>
          <tr>
            <td>3x</td>
            <td>onderzeeër/Torpedobootjager</td>
            <td>3</td>
          </tr>
          <tr>
            <td>4x</td>
            <td>Patrouilleschip</td>
            <td>2</td>
          </tr>
        </table>
  <img src="../img/Battleship_game_board.svg.png" alt="Flowers" style="margin-left: 56%;
    margin-top: -19%;
    width: 24%;">
<p>Nadat de schepen zijn geplaatst, verloopt het spel in een aantal ronden.
  In elke ronde neemt iedere speler een beurt om een doelvak in het rooster van de tegenstander die moet worden beschoten te noemen.
  De tegenstander vertelt of het vak wordt bezet door een schip, en als het een "hit" is merken zij dit op hun eigen eerste rooster.
  De aanvallende speler neemt nota van de treffer of misser op zijn eigen "volg"rooster, om zich een beeld vormen van de vloot van de tegenstander.
  Doel is dat beide spelers zo door gericht te raden proberen als eerste de volledige locaties van alle schepen van de tegenstander te raden en zo de vloot van de tegenstande "tot zinken" te brengen.

  Wanneer alle coördinaten van een schip zijn geraakt, is het schip gezonken. De eigenaar van het schip deelt dit mee, bijvoorbeeld "Je hebt mijn slagschip laten zinken!".
  Als alle schepen van een speler zijn gezonken, is het spel afgelopen en wint de tegenstander.

  Bij zeeslag op de computer worden geen coördinaten genoemd, maar wordt het vakje op het volgrooster geselecteerd dat geraakt moet worden door erop te klikken of dit op een touchscreen aan te tikken.
  Hierbij is dan meteen te zien of de treffer raak is of niet(rake vakjes worden rood gekleurd). Dit gaat vaak gepaard met geluidseffecten, zoals "plons" bij een misser en "boem" bij een treffer.
  Zodra een schip is "gezonken" wordt dit dan gemeld. Hierbij wordt ook aangegeven welk schip is gezonken. Ook dit gaat vaak gepaard met een geluid en/of een animatie van het zinkende schip.
  Deze versie kan met twee spelers worden gespeeld of door één speler tegen de computer. Zodra een vloot volledig is gezonken is het spel ten einde en wordt aangegeven wie er heeft gewonnen.</p>
<a class="bron" href="https://nl.wikipedia.org/wiki/Zeeslag_(spel)">Bron Wikipedia</a>
</div>
</body>
</html>


<?php require 'footer.php'; ?>

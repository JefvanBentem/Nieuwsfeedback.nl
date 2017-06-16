<?php
//Start de sessies
session_start();
//Check of iemand al is ingelogd
if (isset($_SESSION["ingelogd"])) {
  //Als je bent ingelogd mag je hier weg
  header("Location: /adminpanel.php");
  exit;
}
//Checkt of je gebruikersnaam en wachtwoord hebt ingevuld
if (isset($_POST['gebruikersnaam']) && isset($_POST['wachtwoord'])) {
  //Variabelen instellen
  $gebruikersnaam = $_POST['gebruikersnaam'];
  $wachtwoord = $_POST['wachtwoord'];
  //Importeer config
  include('classes/config.php');
  //Verificatie van gebruikersnaam en wachtwoord
  if ($gebruikersnaam == adminusername && $wachtwoord == adminwachtwoord) {
    //Goede inlog maak de sessie
    $_SESSION["ingelogd"] = true;
    header("Location: /adminpanel.php");
    exit;
  } else {
    //Geen goede inlog
    $message = "Foute inloggegevens!";
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/favi.png" sizes="16x16">
    <title>Adminlogin</title>
    <style>
    body {
      font-family: 'Libre Franklin', sans-serif;
    }
    * {
      margin: 0;
    }
    .forumcontainer {
      padding-top: 30vh;
      width: 330px;
      margin: 0 auto;
      text-align: center;
    }
    .forumcontainer input {
      width: 100%;
      margin-bottom: 10px;
      height: 50px;
      padding-left: 10px;
      box-sizing: border-box;
    }
    .blauwgroot {
      background-color: #0c5293;
      color: white;
      border: none;
    }
    @media (max-width: 500px) {
      .forumcontainer {
        width: 90%;
      }
    }
    </style>
  </head>
  <body>
    <section>
      <div class="forumcontainer">
        <form action="adminlogin.php" method="post">
          <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
          <br>
          <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
          <br>
          <input type="submit" class="blauwgroot" value="Verzenden">
        </form>
      </div>
      <p><?php
        //Message display
        echo $message;
      ?></p>
    </section>
    <noscript id="styles">
      <link href="fonts/Franklin.css" rel="stylesheet">
    </noscript>
    <script>
      var loadDeferredStyles = function() {
          var addStylesNode = document.getElementById("styles");
          var replacement = document.createElement("div");
          replacement.innerHTML = addStylesNode.textContent;
          document.body.appendChild(replacement)
          addStylesNode.parentElement.removeChild(addStylesNode);
      };
      var raf = requestAnimationFrame || mozRequestAnimationFrame ||
          webkitRequestAnimationFrame || msRequestAnimationFrame;
      if (raf) raf(function() {
          window.setTimeout(loadDeferredStyles, 0);
      });
      else window.addEventListener('load', loadDeferredStyles);
    </script>
  </body>
</html>

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
    $_SESSION["ingelogd"] = true;
    header("Location: /adminpanel.php");
    exit;
  } else {
    $message = "Foute inloggegevens!";
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminlogin</title>
  </head>
  <body>
    <section>
      <h1>Adminlogin</h1>
      <form action="adminlogin.php" method="post">
        <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
        <br>
        <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
        <br>
        <input type="submit">
      </form>
      <p><?php
        //Message display
        echo $message;
      ?></p>
    </section>
  </body>
</html>

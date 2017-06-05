<?php
//Start de sessies
session_start();
//Check of iemand wel is ingelogd
if (!isset($_SESSION["ingelogd"])) {
  //Als je niet bent ingelogd mag je hier weg
  header("Location: adminlogin.php");
  exit;
} else {
  //Krijg de naam
  if (isset($_POST['naam'])) {
    //Set de naam
    $naam = $_POST['naam'];
    //Importeer alles
    include('classes/import.php');
    //Object aanmaken
    $object = New admin;
    //Maak nieuwsbrief
    $output = $object->maaknieuwsbrief($naam);
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/favi.png" sizes="16x16">
    <title>Maaknieuwsbrief</title>
  </head>
  <body>
    <section>
      <form action="maaknieuwsbrief.php" method="post">
        <input type="text" name="naam" placeholder="Naam" required>
        <br>
        <input type="submit">
      </form>
      <p><?php
      echo $output;
      ?></p>
      <p><a href="adminpanel.php">Ga terug</a></p>
    </section>
  </body>
</html>

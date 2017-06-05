<?php
//Start de sessies
session_start();
//Check of iemand wel is ingelogd
if (!isset($_SESSION["ingelogd"])) {
  //Als je niet bent ingelogd mag je hier weg
  header("Location: http://www.hekmansuelmann.nl");
} else {
  //Importeer config
  include('classes/config.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultaten</title>
  </head>
  <body>
    <section>

    </section>
  </body>
</html>

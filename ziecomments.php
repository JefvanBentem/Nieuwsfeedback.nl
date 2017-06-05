<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Start de sessies
session_start();
//Check of iemand wel is ingelogd
if (!isset($_SESSION["ingelogd"])) {
  //Als je niet bent ingelogd mag je hier weg
  header("Location: adminlogin.php");
  exit;
} else {
  //Importeer alles
  include('classes/import.php');
  $object = New admin;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziecomments</title>
    <style>
    .navteller {
      float: left;
    }
    .selected {
      text-decoration: underline;
    }
    </style>
  </head>
  <body>
    <section>
      <ul>
      <?php
      //Nieuwsbrief
      $nieuwsbrief = $_GET['nieuwsbrief'];
      //Zoek de hoeveelheid pagina's uit
      $hoeveelheidqueries = $object->hoeveelcomments($nieuwsbrief);
      $hoeveelheidpaginas = $hoeveelheidqueries / 10;
      $hoeveelheidpaginas = ceil($hoeveelheidpaginas);
      //Huidige pagina nummer
      $page = isset($_GET['page']) ? $_GET['page'] : 0;
      //Vanaf wat wil je zien
      $vanafwelknummerwiljezien = $page * 10;
      //Krijg de nieuwsbrieven
      $krijgallecomments = $object->krijgallecomments($vanafwelknummerwiljezien, $nieuwsbrief);
      //Loop voor iedere nieuwsbrief
      while ($array = mysqli_fetch_array($krijgallecomments)) {
        //Output de berichten
        echo "<li><p>";
        echo htmlentities($array['bericht']);
        echo "</p></li>";
      }
      ?>
      </ul>
      <p>Pagina's:</p>
      <?php
      //Pagina systeem
      $i=0;
      for($i=0; $i<$hoeveelheidpaginas; $i++) {
        $class = $i == $page ? 'selected' : '';
        echo "<div class='navteller {$class}'>";
        echo "<a style='padding:8px;' href='?page={$i}'>{$i}</a>";
        echo "</div>";
      }
      ?>
    </section>
  </body>
</html>

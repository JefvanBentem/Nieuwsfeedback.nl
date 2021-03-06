<?php
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
    <link rel="icon" type="image/png" href="img/favi.png" sizes="16x16">
    <title>Ziecomments</title>
    <style>
    .navteller {
      float: left;
    }
    .selected {
      text-decoration: underline;
    }
    body {
      font-family: 'Libre Franklin', sans-serif;
    }
    </style>
  </head>
  <body>
    <section>
      <ul>
      <?php
      //Zet de variabelen
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
        echo "<a style='padding:8px;' href='?page={$i}&nieuwsbrief={$nieuwsbrief}'>{$i}</a>";
        echo "</div>";
      }
      ?>
      <br>
      <p><a href="resultaten.php">Ga terug</a></p>
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

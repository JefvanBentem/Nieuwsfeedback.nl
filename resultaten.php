<?php
//Start de sessies
session_start();
//Check of iemand wel is ingelogd
if (!isset($_SESSION["ingelogd"])) {
  //Als je niet bent ingelogd mag je hier weg
  header("Location: http://www.hekmansuelmann.nl");
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
    <title>Resultaten</title>
    <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    .selected {
      background-color: green;
    }
    </style>
  </head>
  <body>
    <section>
    <table>
      <tr>
        <th>Nieuwsbriefnaam</th>
        <th>Likes</th>
        <th>Dislikes</th>
        <th>Aantal comments</th>
        <th>Zie comments</th>
        <th>Verwijder</th>
      </tr>
      <?php
      //Zoek de hoeveelheid pagina's uit
      $hoeveelheidqueries = $object->aantalnieuwsbrieven();
      $hoeveelheidpaginas = $hoeveelheidqueries / 10;
      $hoeveelheidpaginas = ceil($hoeveelheidpaginas);
      //Huidige pagina nummer
      $page = isset($_GET['page']) ? $_GET['page'] : 0;
      //Vanaf wat wil je zien
      $vanafwelknummerwiljezien = $page * 10;
      //Krijg de nieuwsbrieven
      $krijgallenieuwsbrieven = $object->krijgallenieuwsbrieven($vanafwelknummerwiljezien);
      //Loop voor iedere nieuwsbrief
      while ($array = mysqli_fetch_array($krijgallenieuwsbrieven)) {
        //Zet de variabelen
        $naam = $array['randomid'];
        $likes = $object->hoeveellikes($naam);
        $dislikes = $object->hoeveeldislikes($naam);
        $aantalcomments = $object->hoeveelcomments($naam);
        $ziecomment = "Komt nog";
        $verwijder = "Komt nog";
        //Display in tabel
        echo "<tr>";
        echo "<td>$naam</td>";
        echo "<td>$likes</td>";
        echo "<td>$dislikes</td>";
        echo "<td>$aantalcomments</td>";
        echo "<td>$ziecomment</td>";
        echo "<td>$verwijder</td>";
        echo "</tr>";
      }
      ?>
    </table>
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

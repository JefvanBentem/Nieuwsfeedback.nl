<?php
//Check of allebei de benodigde variabelen zijn gezet
if (isset($_GET['nieuwsbriefid']) && isset($_GET['actie'])) {
  //Zet de variabelen
  $actie = $_GET["actie"];
  $nieuwsbriefid = $_GET["nieuwsbriefid"];
  //Importeer de php classes
  include 'classes/import.php';
  //Maak een object aan
  $object = New main;
  //Stemmen
  $output = $object->stem($actie, $nieuwsbriefid);
} else {
  //Als je niet alle variabelen hebt gezet dan krijg je dit
  $error = "Er is iets fout gegaan!";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/favi.png" sizes="16x16">
    <title>Stemmen</title>
    <style>
    body {
      font-family: 'Libre Franklin', sans-serif;
    }
    </style>
  </head>
  <body>
    <p>
    <?php
    //Output de errors
    if (isset($error) or isset($output)) {
      echo $output;
      echo $error;
    }
    ?>
  </p>
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

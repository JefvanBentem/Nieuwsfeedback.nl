<?php
//Start de sessies
session_start();
//Check of iemand wel is ingelogd
if (!isset($_SESSION["ingelogd"])) {
  //Als je niet bent ingelogd mag je hier weg
  header("Location: adminlogin.php");
  exit;
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
    <link rel="icon" type="image/png" href="img/favi.png" sizes="16x16">
    <title>Adminpanel</title>
    <style>
      body {
        font-family: 'Libre Franklin', sans-serif;
      }
      section {
        width: 90%;
        margin: 0 auto;
      }
      * {
        margin: 0;
      }
    </style>
  </head>
  <body>
    <section>
      <h1>Adminpanel</h1>
      <p>Hallo <?php echo adminusername; ?>,</p>
      <p>Wat wil je doen?</p>
      <ul>
        <li><a href="resultaten.php">Resultaten inzien</a></li>
        <li><a href="maaknieuwsbrief.php">Nieuwsbrief aanmaken</a></li>
      </ul>
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

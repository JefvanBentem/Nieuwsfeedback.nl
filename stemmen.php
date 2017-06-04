<?php
if (empty($_GET["nieuwsbriefid"]) or empty($_GET["actie"])) {
  $error = "Er is iets fout gegaan!";
} else {
  $actie = $_GET["actie"];
  $nieuwsbriefid = $_GET["nieuwsbriefid"];
  include 'classes/import.php';
  $object = New main;
  $error = $object->stem($actie, $nieuwsbriefid);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stemmen</title>
  </head>
  <body>
    <p>
    <?php
    if (isset($error)) {
      echo $error;
    }
    ?>
  </p>
  </body>
</html>

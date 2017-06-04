<?php
$_GET['test'] = "Hallo";
if (isset($_GET['nieuwsbriefid']) && isset($_GET['actie'])) {
  $actie = $_GET["actie"];
  $nieuwsbriefid = $_GET["nieuwsbriefid"];
  include 'classes/import.php';
  $object = New main;
  $output = $object->stem($actie, $nieuwsbriefid);
} else {
  $error = "Er is iets fout gegaan!";
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
      echo $output;
      echo $error;
    }
    ?>
  </p>
  </body>
</html>

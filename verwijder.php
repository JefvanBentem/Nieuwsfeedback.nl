<?php
//Start de sessies
session_start();
//Check of iemand wel is ingelogd
if (!isset($_SESSION["ingelogd"])) {
  //Als je niet bent ingelogd mag je hier weg
  header("Location: adminlogin.php");
} else {
  //Importeer alles
  include('classes/import.php');
  //Verwijderid
  $verwijderid = $_GET['nieuwsbrief'];
  //Nieuw object
  $object = New admin;
  //Verwijder het
  $object->verwijdernieuwsbrief($verwijderid);
  //Voor de zekerheid
  header("Location: resultaten.php");
}

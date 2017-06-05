<?php
class main {
  //Database connectie variable
  protected $connectie;

  //Functie voor het aanmaken van een database connectie
  public function __construct() {
    $this->connectie=mysqli_connect(dbhost,dbgebruikersnaam,dbwachtwoord,dbnaam);
    if (!$this->connectie) {
      die('De database werkt niet. Wij proberen dit zo spoedig mogelijk te verhelpen.');
    }
  }
  //Functie voor het beveiligen van alles wat in de database gaat
  public function beveilig($input) {
    $input = mysqli_real_escape_string($this->connectie, $input);
    return $input;
  }
  //Functie voor het registreren van de stemmen
  public function stem($actie, $nieuwsbriefid) {
    $output1 = $this->checkactie($actie);
    if (!$output1) {
      return "Dat is geen bestaande actie!";
    }
    $output2 = $this->checknieuwsbriefid($nieuwsbriefid);
    if (!$output2) {
      return "Dat is geen bestaand nieuwsbriefid!";
    }
    //Alles is gecheckt
    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
    $tijd = time();
    $sql = "INSERT INTO nieuwsbriefstem(ip,type,tijd,nieuwsbriefid) VALUES('$ip','$actie','$tijd','$nieuwsbriefid')";
    $resultaat = mysqli_query($this->connectie, $sql);
    if ($resultaat) {
      if ($actie != "like") {
        $m = 0;
      } else {
        $m = 1;
      }
      header("Location: /comment.php?m=$m&nieuwsbriefid=$nieuwsbriefid");
    } else {
      return "Probeer het later opnieuw.";
    }
  }
  //Checken of de actie wel mogelijk is
  public function checkactie($actie) {
    if ($actie != "like" && $actie != "dislike") {
      return false;
    } else {
      return true;
    }
  }
  //Checken of het nieuwsbriefid wel bestaat
  public function checknieuwsbriefid($id) {
    $id = $this->beveilig($id);
    $sql = "SELECT * FROM nieuwsbrief WHERE randomid = '$id'";
    $resultaat = mysqli_query($this->connectie, $sql);
    if (mysqli_num_rows($resultaat) <= 0) {
      return false;
    } else {
      return true;
    }
  }
  public function postbericht($bericht, $nieuwsbriefid) {
    if (strlen($bericht) > 2000) {
      return "Het bericht mag niet langer zijn dan 2000 karakters.";
    }
    $check = $this->checknieuwsbriefid($nieuwsbriefid);
    if (!check) {
      return "Dat is geen bestaande nieuwsbriefid";
    }
    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
    $tijd = time();
    $bericht = $this->beveilig($bericht);
    $sql = "INSERT INTO nieuwsbriefreactie(ip,tijd,nieuwsbriefid,bericht) VALUES('$ip','$tijd','$nieuwsbriefid','$bericht')";
    $resultaat = mysqli_query($this->connectie, $sql);
    if ($resultaat) {
      header("Location: /bedankt.php");
    } else {
      return "Probeer het later opnieuw!";
    }
  }
}

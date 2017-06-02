<?php
class main {
  protected $connectie;

  public function __construct() {
    $this->connectie=mysqli_connect(dbhost,dbgebruikersnaam,dbwachtwoord,dbnaam);
    if (!$this->connectie) {
      die('De database werkt niet. Wij proberen dit zo spoedig mogelijk te verhelpen.');
    }
  }
  public function beveilig($input) {
    $input = mysqli_real_escape_string($this->connectie, $input);
    return $input;
  }
  public function stem($actie, $nieuwsbriefid) {
    $actie = $this->beveilig($actie);
    $nieuwsbriefid = $this->beveilig($nieuwsbriefid);
    $output1 = $this->checkactie($actie);
    if ($output1 != true) {
      return $output1;
    }
    $output2 = $this->checknieuwsbriefid($nieuwsbriefid);
    if ($output2 != true) {
      return $output2;
    }
    //Alles is gecheckt
    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
    $tijd = time();
    $sql = "INSERT INTO nieuwsbriefstem(ip,type,tijd,nieuwsbrief) VALUES('$ip','$actie','$tijd','$nieuwsbriefid')";
    $resultaat = mysqli_query($this->connectie, $sql);
    if ($resultaat) {
      header("Location: /comment.php");
    } else {
      return "Probeer het later opnieuw.";
    }
  }
  public function checkactie($actie) {
    if ($actie != "like" && $actie != "dislike") {
      return "Je actie moet like of dislike zijn.";
    } else {
      return true;
    }
  }
  public function checknieuwsbriefid($id) {
    $sql = "SELECT * FROM nieuwsbrief WHERE randomid = '$id'";
    $resultaat = mysqli_query($this->connectie, $sql);
    if (mysqli_num_rows($resultaat) >= 0) {
      return "Die nieuwsbrief bestaat niet!";
    } else {
      return true;
    }
  }
}

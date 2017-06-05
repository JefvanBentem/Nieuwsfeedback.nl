<?php
class admin {
  //Database connectie variable
  protected $connectie;

  //Functie voor het aanmaken van een database connectie
  public function __construct() {
    $this->connectie=mysqli_connect(dbhost,dbgebruikersnaam,dbwachtwoord,dbnaam);
    if (!$this->connectie) {
      die('De database werkt niet. Wij proberen dit zo spoedig mogelijk te verhelpen.');
    }
  }
  //Sluit de database connectie
  public function __destruct() {
    mysqli_close($this->connectie);
  }
  //Functie voor het beveiligen van alles wat in de database gaat
  public function beveilig($input) {
    $input = mysqli_real_escape_string($this->connectie, $input);
    return $input;
  }
  //Tel het aantal nieuwsbrieven
  public function aantalnieuwsbrieven() {
    $sql = "SELECT COUNT(*) FROM nieuwsbrief";
    $resultaat = mysqli_query($this->connectie, $sql);
    $row = mysqli_fetch_assoc($resultaat);
    return $row['COUNT(*)'];
  }
  //Krijg alle nieuwsbrieven
  public function krijgallenieuwsbrieven($startop) {
    $startop = $this->beveilig($startop);
    $sql = "SELECT randomid FROM nieuwsbrief ORDER BY `nieuwsbrief`.`aangemaaktop` DESC LIMIT 10 OFFSET $startop";
    $resultaat = mysqli_query($this->connectie, $sql);
    return $resultaat;
  }
  //Aantallikes
  public function hoeveellikes($nieuwsbrief) {
    $nieuwsbrief = $this->beveilig($nieuwsbrief);
    $sql = "SELECT COUNT(*) FROM nieuwsbriefstem WHERE nieuwsbriefid='$nieuwsbrief' AND type='like'";
    $resultaat = mysqli_query($this->connectie, $sql);
    $row = mysqli_fetch_assoc($resultaat);
    return $row['COUNT(*)'];
  }
  //Aantaldislikes
  public function hoeveeldislikes($nieuwsbrief) {
    $nieuwsbrief = $this->beveilig($nieuwsbrief);
    $sql = "SELECT COUNT(*) FROM nieuwsbriefstem WHERE nieuwsbriefid='$nieuwsbrief' AND type='dislike'";
    $resultaat = mysqli_query($this->connectie, $sql);
    $row = mysqli_fetch_assoc($resultaat);
    return $row['COUNT(*)'];
  }
  //Aantalcomments
  public function hoeveelcomments($nieuwsbrief) {
    $nieuwsbrief = $this->beveilig($nieuwsbrief);
    $sql = "SELECT COUNT(*) FROM nieuwsbriefreactie WHERE nieuwsbriefid='$nieuwsbrief'";
    $resultaat = mysqli_query($this->connectie, $sql);
    $row = mysqli_fetch_assoc($resultaat);
    return $row['COUNT(*)'];
  }
  //Krijgallecomments
  public function krijgallecomments($startop, $nieuwsbrief) {
    $startop = $this->beveilig($startop);
    $nieuwsbrief = $this->beveilig($nieuwsbrief);
    $sql = "SELECT bericht FROM nieuwsbriefreactie WHERE nieuwsbriefid='$nieuwsbrief' ORDER BY `nieuwsbriefreactie`.`tijd` DESC LIMIT 10 OFFSET $startop";
    $resultaat = mysqli_query($this->connectie, $sql);
    return $resultaat;
  }
  //Verwijdernieuwsbrief
  public function verwijdernieuwsbrief($id) {
    $id = $this->beveilig($id);
    $sql1 = "DELETE FROM nieuwsbrief WHERE randomid='$id'";
    $sql2 = "DELETE FROM nieuwsbriefreactie WHERE nieuwsbriefid='$id'";
    $sql3 = "DELETE FROM nieuwsbriefstem WHERE nieuwsbriefid='$id'";
    $resultaat1 = mysqli_query($this->connectie, $sql1);
    $resultaat2 = mysqli_query($this->connectie, $sql2);
    $resultaat3 = mysqli_query($this->connectie, $sql3);
    header("Location: resultaten.php");
    exit;
  }
}

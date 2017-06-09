<?php
//Zet een message variabele
$message = $_GET["m"];
//Als het niet 1 of 0 is dan is het 0
if ($message != 1 and $message != 0) {
  $message = 1;
}
//Zet het bericht op de variabele
if ($message == 1) {
  //Bericht als je liked
  $message = "Goed om te horen dat u deze editie leuk vond. Mocht u toch nog iets kwijt willen, dan kan dat hier:";
} else {
  //Bericht als je disliked
  $message = "Oei, helaas heeft deze editie niet voldaan aan uw verwachtingen. Wij zijn erg blij met alle feedback, want zo kunnen wij onze nieuwsbrief blijven verbeteren. Zou u ons kunnen vertellen waarom u deze editie minder vond?";
}
//Als bericht en nieuwsbriefid zijn gezet
if (isset($_POST["bericht"]) && isset($_GET["nieuwsbriefid"])) {
  //Variabelen zetten
  $bericht = $_POST["bericht"];
  $nieuwsbriefid = $_GET["nieuwsbriefid"];
  //Alle classes importeren
  include 'classes/import.php';
  //Object aanmaken
  $object = New main;
  //Bericht posten
  $output = $object->postbericht($bericht, $nieuwsbriefid);
}
//Bericht als iemand niet het nieuwsbriefid heeft maar wel een bericht probeert te verzenden
if (isset($_POST["bericht"]) && !isset($_GET["nieuwsbriefid"])) {
  $output = "Je link is invalid!";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/favi.png" sizes="16x16">
    <title>Hekman Suelmann</title>
    <link href="fonts/Franklin.css" rel="stylesheet">
    <style>
      body {
        font-family: 'Libre Franklin', sans-serif;
      }
      .footer {
        position: absolute;
        bottom: 0px;
        left: 15px;
        color: grey;
        font-size: 0.9em;
      }
      .logocontainer {
        padding-top: 50px;
        width: 300px;
        margin: 0 auto;
      }
      .tekst, .reactievak {
        margin: 0 auto;
        max-width: 90%;
        text-align: center;
      }
      .tekst {
        width: 370px;
        margin-top: 50px;
      }
      .grijs {
        color: grey;
        font-size: 1.1em;
      }
      .reactievak form textarea {
        border-radius: 10px;
        border-width: 2px;
        border-color: grey;
        width: 400px;
        height: 200px;
        max-width: 85vw;
        resize: none;
        border-style: solid;
        font-family: 'Libre Franklin', sans-serif;
        font-size: 1.1em;
        color: grey;
        outline: none;
      }
      .reactievak form input {
        margin-top: 15px;
        background-color: #115695;
        border-radius: 15px;
        border-width: 2px;
        font-size: 1.1em;
        border-color: #115695;
        color: white;
        padding: 5px 10px;
        border-style: solid;
      }
      @media (max-width: 850px) {
        .footer {
          display: none;
        }
        .tekst {
          margin-top: 20px;
        }
        .logocontainer {
          padding-top: 0px;
        }
      }
    </style>
  </head>
  <body>
    <header>
      <div class="logocontainer">
        <img src="img/Logo.png" alt="Logo" style="max-width:100%;max-height:100%;">
      </div>
    </header>
    <section>
      <div class="tekst">
        <h1>Bedankt voor uw reactie!</h1>
        <p class="grijs">
          <?php
            //Ouput $message
            echo $message;
          ?>
        </p>
      </div>
      <div class="reactievak">
        <form action="comment.php<?php
        //Zorgt ervoor dat als je op submit drukt dat de GET wordt meegestuurd
        if(isset($_GET["nieuwsbriefid"])) {
          echo "?nieuwsbriefid=" . $_GET["nieuwsbriefid"];
        }
        ?>" method="post">
          <textarea name="bericht" maxlength="2000" required></textarea>
          <br>
          <input type="submit" value="Verzenden">
        </form>
        <?php
          //Output de output
          echo $output;
        ?>
      </div>
    </section>
    <footer>
      <div class="footer">
        <p>
          &#9400; Copyright 2017 Solid Design - All Rights Reserved
        </p>
      </div>
    </footer>
  </body>
</html>

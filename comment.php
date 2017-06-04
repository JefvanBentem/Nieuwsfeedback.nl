<?php
$message = $_GET["m"];
if ($message != "1" and $message != "0") {
  $message = 1;
}
if ($message == 1) {
  $message = "Bedankt voor uw reactie! Goed om te horen dat u deze editie leuk vond. Mocht u toch nog iets kwijt willen over deze editie, dan kan dat hier:";
} else {
  $message = "Bedankt voor uw reactie! Jammer dat u deze editie wat minder vond. Laat hier achter wat wij in de volgende edities kunnen verbeteren:";
}
if (isset($_POST["bericht"]) && isset($_GET["nieuwsbriefid"])) {
  $bericht = $_POST["bericht"];
  $nieuwsbriefid = $_GET["nieuwsbriefid"];
  include 'classes/import.php';
  $object = New main;
  $output = $object->postbericht($bericht, $nieuwsbriefid);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      }
      .logocontainer {
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
        margin-top: 100px;
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
        max-width: 85vw;
        height: 200px;
      }
      .reactievak form input {
        background-color: #115695;
        border-radius: 15px;
        border-width: 2px;
        border-color: #115695;
        color: white;
        padding: 5px 10px;
      }
      @media (max-width: 550px) {
        .footer {
          display: none;
        }
        .tekst {
          margin-top: 20px;
        }
      }
    </style>
  </head>
  <body>
    <header>
      <div class="logocontainer">
        <img src="img/Logo.png" alt="Logo" height="160px">
      </div>
    </header>
    <section>
      <div class="tekst">
        <h1>Bedankt voor uw reactie!</h1>
        <p class="grijs">
          <?php
            echo $message;
          ?>
        </p>
      </div>
      <div class="reactievak">
        <form action="comment.php<?php
        if(isset($_GET["nieuwsbriefid"])) {
          echo "?nieuwsbriefid=" . $_GET["nieuwsbriefid"];
        }
        ?>" method="post">
          <textarea name="bericht" maxlength="2000" required></textarea>
          <br>
          <input type="submit">
        </form>
        <?php
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

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/favi.png" sizes="16x16">
    <title>Bedankt!</title>
    <style>
    body {
      font-family: 'Libre Franklin', sans-serif;
    }
    .containertekst {
      width: 100vw;
      height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .containertekst2 {
      text-align: center;
    }
    * {
      margin: 0;
    }
    </style>
  </head>
  <body>
    <div class="containertekst">
      <div class="containertekst2">
        <p style="font-size:1.3em;">Bedankt voor uw reactie.</p>
        <p style="color:grey;">U wordt nu automatisch doorgestuurd naar de homepage.</p>
      </div>
    </div>
    <script>setTimeout(function(){window.location.href='http://hekmansuelmann.nl/'},5000);</script>
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

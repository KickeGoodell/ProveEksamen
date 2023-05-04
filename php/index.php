<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" />
    <title>Spørsmål</title>
  </head>
  <body>

<!--PHP elementer som sjekker om du har privileges, om du har det, så slettes de-->

<?php
  session_start();
    if(isset($_SESSION['privileges'])){
      unset($_SESSION['privileges']);
    }
?>

<!--HTML elementer som lager menyen øverst på siden-->

    <div id="menumain">
      <div class="innermenu">
        <a href="faq.php">FAQ</a>
      </div>

      <div class="innermenu">
        <a href="index.php">
          <img src="../Pictures/Snake.svg" height="100" alt="Snake Game Bilde" />
        </a>
      </div>

      <div class="innermenu">
        <a href="logIn.php">Log in</a>
      </div>
    </div>

    <div class="menuunderline"></div>

<!--HTML elementer som lages for å gi deg muligheten til å lage spørsmål, sette navn og tittel på spørsmålet.-->

    <div class="container">
      <h3 id="h1">Ask your own question:</h3>
      <form id="form" method="POST" name="" action="save.php">
        <input type="hidden" name="dbTable" value="faq">
        <label>Name:</label>
        <input type='text' name='qName' style='width: 50%' placeholder="Please insert a first name">
        <label>Question title:</label>
        <input type='text' name='qTitle' style='width: 50%' placeholder="Please insert a title for your question">
        <label for='type'>Question:</label>
        <textarea name='question' cols='10' rows='5' style='width: 50%'></textarea>
        <button type="submit" name="submit" style='width: 100px' id="submitBtn">Submit</button>
      </form>
    </div>

<!--Script for å lage funksjonalitet på knappen, slik at når du trykker så kommer det opp en melding-->

    <script>

      const submitBtnEl= document.getElementById("submitBtn")

      submitBtnEl.addEventListener("click", function(){
      alert("Thank you for submitting your question. Someone will reply to it shortly!");
      });

    </script>




  </body>
</html>

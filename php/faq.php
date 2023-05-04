<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" />
    <title>FAQ</title>
  </head>
  <body>

<!--HTML elementer som lager menyen øverst på siden-->

    <div id="menumain">
      <div class="innermenu">
        <a href="faq.php"><span class="ColoredText">FAQ</span></a>
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


<!--PHP elementer som først kobler til databasen ved bruk av å include den "connect" dokumentet
    Deretter henter den all informasjonen fra tabelen "FAQ" i databasen, deretter lager den html
    elementer som skal legge inn og vise all informasjonen den finner under tabelen. Den lager knapper
    som kan trykkes for å vise svar og tittel-->

  <?php

  include "connect.php";
  $sql = "SELECT * FROM `FAQ`";
  $result = mysqli_query($conn, $sql);
echo "<div class='questionContainer'>";
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) {
      if ($row["Visibility"] == "yes") {
        echo "
        <div class='contentContainer'>
        <button type='button' class='collapseFaq'>" . $row["QuestionTitle"] . "</button>
        <div class = 'faqContent'>
          <h3>" . $row["Name"] . "</h3>
          <p>" . $row["Question"] . "</p>
          <h4>" . $row["Answer"] . "</h3>
        </div>
        </div>
        ";
      }
    }
  }
  echo "</div>";
?>

<!--Script som trenges for å lage funksjonalitet til knappene-->

<script>

  var collFaqEl = document.getElementsByClassName("collapseFaq");
  
  for (var i = 0; i < collFaqEl.length; i++) {
    collFaqEl[i].addEventListener("click", function() {
      this.classList.toggle("faqActive");
      var faqContent = this.nextElementSibling;
      if (faqContent.style.display === "block") {
        faqContent.style.display = "none";
      } else {
        faqContent.style.display = "block";
      }
    });
  }
</script>

  </body>
</html>

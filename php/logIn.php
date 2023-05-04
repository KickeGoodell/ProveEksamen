<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" />
    <title>Log In</title>
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
          <img src="../Pictures/Snake.svg" height="100" alt="Enrique Logo" />
        </a>
      </div>

      <div class="innermenu">
        <a href="logIn.php"><span class="ColoredText">Log in</span></a>
      </div>
    </div>

    <div class="menuunderline"></div>

<!--HTML elementer som lages for å gi deg muligheten til å logge inn på siden. Det gjør du ved å legge inn
    info til en bruker og deretter trykke på submit knappen-->

    <div class="container">
    <h3>Please Log In</h3>
    <form method="post" id="form">
      <label for="Username">Username:</label>
      <input type="text" name="Username" /><br />
      <label for="Password">Password:</label>
      <input type="Password" name="Password" /><br />
      <button type="submit" value="Log in" name="submit" class="loginSubmit">Submit</button>
    </form>
    </div>

<!--PHP elementer som først kobler til databasen ved bruk av å include den "connect" dokumentet
    Deretter lytter den etter submit, hvis den finner det, så gjør det om dataen du har skrevet inn
    i innloggingen til variabeler. Etter det, henter den all informasjonen fra tabelen "WebUsers" og
    ser om det du har tastet inn stemmer med det som ligger i databasen. Hvis den ikke klarer å koble
    til databasen, så gir den opp, hvis det du skrev ikke stemmer med en eksisterende bruker, så får du feil
    men, hvis alt stemmer, så sender den deg til admin siden-->

    <?php
      include 'connect.php';

      if(isset($_POST['submit'])){
        
        $usrn = mysqli_real_escape_string($conn, $_POST['Username']);
        $pwd = mysqli_real_escape_string($conn, $_POST['Password']);

        $sql = "SELECT * FROM WebUsers where Username='$usrn'";

        $result = mysqli_query($conn, $sql)
          or die('Error connecting to database.');

        if (mysqli_num_rows($result) > 0 ) {
          while($row = mysqli_fetch_assoc($result)) {
            if ($row["Password"] == $pwd) {
              $_SESSION["privileges"] = $row["Privileges"];
              header("Location: admin.php");
            } else {
              echo '<p>feil brukernavn eller passord</p>';
            }
          }
        } else {
          echo '<p>feil brukernavn eller passord</p>';
        }
      }
    ?>














  </body>
</html>

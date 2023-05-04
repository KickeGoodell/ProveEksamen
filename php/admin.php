<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>

<!--Ved starten at tabben, så skal denne php funksjonen kjøre, som skjekker enkelt om 
    brukeren av nettsiden har privileges all, hvis ikke, så skal brukeren ikke komme inn
    på siden også sender den deg til hovedsiden-->

<?php
    session_start();
    if($_SESSION["privileges"] != "all"){
        header("Location: index.php");
    }
?>

<!--HTML elementer som lager en log ut knapp på siden og legger til en overskrift på siden-->

<span id="adminPage" class="loginORout">Log out</span>
  <script>
    var adminPage = document.getElementById("adminPage");
    adminPage.onclick = function() {
      window.location = "login.php";
    }
  </script>

<h1 id="h1">Account information</h1>

<!--PHP elementer som først kobler til databasen ved bruk av å include den "connect" dokumentet
    Deretter henter den all informasjonen fra tabelen "WebUsers" i databasen, deretter lager den html
    elementer som skal legge inn all informasjonen den finner under tabelen-->

  <?php

    include 'connect.php';
    $sql = 'SELECT * FROM WebUsers';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      echo "<h2>Admin Users</h2>";
      while($row = mysqli_fetch_assoc($result)) {
        echo "
        <form method='POST' name='' action='update.php'>
        <input type='hidden' name='dbtable' value='user'>
        <label for='type'>ID: " . $row["ID"] . "</label>
        <input type='hidden' name='id' value='" . $row["ID"] . "'>
        <label for='type'>Username:</label>
        <input type='text' name='username' style='width: 120px' value='" . $row["Username"] . "'>
        <label for='type'>New Password:</label>
        <input type='text' name='password' style='width: 120px' value=''>
        <label>Privileges:</label>
        <input type='text' name='privileges' style='width: 45px' value='" . $row["Privileges"] . "'>
        <button type='hidden' name='action' value='update'>update</button>
        <button type='submit' name='action' value='remove'>delete</button>
        </form>";
        echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
      }
    } else {
      echo "0 results";
    }

    mysqli_close($conn);
  ?>

<!--HTML elementer som gir muligheten til å lage flere brukere inn i siden-->

  <form method="POST" name="" action="save.php">
    <input type="hidden" name="dbTable" value="WebUsers">
    <label>Username:</label>
    <input type="text" name="Username" style='width: 120px;'>
    <label for="type">Password:</label>
    <input type="text" name="Password" id="password" style='width: 120px'>
    <label>Privileges:</label>
    <input type="text" name="Privileges" style='width: 45px'>
    <button type="submit" name="submit">Save</button>
  </form>




</body>
</html>
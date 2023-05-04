
<!--PHP elementer som først kobler til databasen ved bruk av å include den "connect" dokumentet derretter 
    lytter koben på action knappene fra admin siden. Hvis den hører action så skal den gi deg muligheten til å
    forandre dataen som sto der ifra før til det du har redigert den til på admin siden. Hvis den lytter etter
    remove, så skal den slette all dataen fra tabelen, deretter skal den stenge av tilkoblingen til databasen og
    sende deg tilbake til den siden du var på. Hvis den ikke klarte det, skal den fortsatt stenge av koblingen og
    komme med en error. Hvis du på mystisk sett klarte å komme deg til denne siden, skal det bare stå "Du skal ikke
    være her"-->

<?php
    include 'connect.php';

    if (isset($_POST["action"])){
        $dbtable = $_POST['dbtable'];
        $id = $_POST['id'];
        if ($dbtable == 'user'){
        $location = "Location: admin.php";
        if ($_POST["action"] == 'update'){
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $privileges = mysqli_real_escape_string($conn, $_POST['privileges']);
            if(empty($password)){
                $sql = "UPDATE WebUsers SET username = '$username' , privileges = '$privileges' WHERE id='$id';"; 
            } else {
                $sql = "UPDATE  WebUsers SET username = '$username' , password = '$password' , privileges = '$privileges' WHERE id='$id';";
            }
        }   
    } else if($dbtable == 'faq'){ //Er ikke i bruk enda
        $location = '"Location: manageFAQ.php"';
        if ($_POST["action"] == 'update'){
            $qName = mysqli_real_escape_string($conn, $_POST['qName']);
            $qTitle = mysqli_real_escape_string($conn, $_POST['qTitle']);
            $question = mysqli_real_escape_string($conn, $_POST['question']);
            $aName = mysqli_real_escape_string($conn, $_POST['aName']);
            $answer = mysqli_real_escape_string($conn, $_POST['answer']);
            $show = mysqli_real_escape_string($conn, $_POST['show']);

            $sql = "UPDATE FAQ SET qName = '$qName', qTitle = '$qTitle', question = '$qQuestion', aName = '$aName', answer = '$answer', show = '$show' WHERE id='$id';";
        }
    }
    if ($_POST["action"] == 'remove'){
    $sql = "DELETE FROM WebUsers WHERE id ='$id';";
    }
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header($location);
        } else {
            echo "Error";
            mysqli_close($conn);
        }
} else{
    echo '<p> You are not supposed to be here! </p>';
}

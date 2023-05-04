
<!--PHP elementer som først kobler til databasen ved bruk av å include den "connect" dokumentet derretter 
    lytter koben på submit knappene fra index siden og admin siden. Hvis den hører submit fra noen av stedene
    så skal den ta dataen eller informasjonen du har lagt inn på disse sidene og legge det i en av tabelene på 
    databasen. Hvis den ikke klarer å koble opp mot databasen, så skal det vise "error" og mysql feilen, 
    hvis den kobler til, men ikke hører etter submit, så skal den bare sende deg til hoved siden-->

<?php
    include 'connect.php';

    if (isset($_POST["submit"])){
        $dbTable = mysqli_real_escape_string($conn, $_POST["dbTable"]);

        if($dbTable == "faq")
        {
        $location = "Location: index.php";
        $qName = mysqli_real_escape_string($conn, $_POST['qName']);
        $qTitle = mysqli_real_escape_string($conn, $_POST['qTitle']);
        $question = mysqli_real_escape_string($conn, $_POST['question']);

        $sql = "INSERT INTO FAQ (Name, QuestionTitle, Question) VALUES ('$qName', '$qTitle', '$question');";
        }

        if($dbTable == "WebUsers")
        {
        $location = "Location: admin.php";
        $username = mysqli_real_escape_string($conn, $_POST['Username']);
        $password = mysqli_real_escape_string($conn, $_POST['Password']);
        $privileges = mysqli_real_escape_string($conn, $_POST['Privileges']);

        $sql = "INSERT INTO WebUsers (Username, Password, Privileges) VALUES ('$username', '$password', '$privileges');";
        }


        if(mysqli_multi_query($conn, $sql)){
            header($location);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }else {
        header("Location: index.php");
    }

?>
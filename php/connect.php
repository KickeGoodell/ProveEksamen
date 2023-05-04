<!--Setter opp komunikasjonen til database serveren-->

<?php
$IP = "10.2.2.195";                                                          //lager en variabel med IP addressen til database serveren
$username = "enrique";                                                       //lager en variabel med brukernavn til mysql brukeren jeg skal koble inn med
$password = "d9g[4k/Pphr10w00";                                              //Lager en variabel med passordet til mysql brukeren
$database = "Arsoppgave";                                                    //Lager en variabel med navnet til databasen jeg skal koble til

$conn = mysqli_connect($IP, $username, $password, $database);                //Lager en variabel med mysqli_connect funksjonen ved bruk av de variabelene jeg lagde ove

if (!$conn) {                                                                //IF statement som kjører hvis jeg ikke kan koble til
    die("Connection to the database failed") . mysqli_connect_error();       //Hvis ikke den kobler til, skal den slutte å prøve, legge ut deretter en string og feil meldingen
}
?>





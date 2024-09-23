<?php
session_start();
spl_autoload_register();

use Business\UserService;
use Entities\User;
use Exceptions\WachtwoordenKomenNietOvereenException;

$error = "";
$update = false;
$username = $_SESSION["username"];
$gebruikerSvc = new UserService();
$gebruikerData = $gebruikerSvc->getUserByName($username);

if (isset($_POST["btnUpdate"])) {
    $wachtwoord = "";
    $wachtwoordHerhaal = "";
    
    if (!empty($_POST["txtWachtwoord"]) && !empty($_POST["txtWachtwoordHerhaal"])) {
        $wachtwoord = $_POST["txtWachtwoord"];
        $wachtwoordHerhaal = $_POST["txtWachtwoordHerhaal"];
    } else {
        $error .= "Beide wachtwoordvelden moeten ingevuld worden.<br>";
    }
    
    if ($error == "") {
        try {
            $wachtwoord = $_POST["txtWachtwoord"];	
            $wachtwoordHerhaal = $_POST["txtWachtwoordHerhaal"];
        
            $gebruiker = new User();
            $gebruiker->setUserName($username);
            $gebruiker->setWachtwoord($wachtwoord, $wachtwoordHerhaal);
        
            $gebruikerDAO = new UserService();
            $gebruikerDAO->updateWachtwoord($gebruiker);
            $_SESSION["gebruiker"] = serialize($gebruiker);
            echo "Uw gegevens zijn succesvol gewijzigd.<br>";
            $update = true;
    } catch (WachtwoordenKomenNietOvereenException $e) {
        $error .= "De ingevulde wachtwoorden komen niet overeen.<br>";
    }
    }
}

if ($error == "" && $update) {
    header("location: Presentation/viewGegevensGewijzigd.php");
    exit;
} else if ($error != "") {
    echo "<span style=\color:red;\">" . $error . "</span>";
}

include("Presentation/header.php");
include("Presentation/viewGebruikerWachtwoordWijzigen.php");
include("Presentation/footer.php");
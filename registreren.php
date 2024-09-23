<?php
session_start();
spl_autoload_register();

use Business\UserService;
use Entities\User;
use Exceptions\GebruikerBestaatAlException;
use Exceptions\WachtwoordenKomenNietOvereenException;

$error = "";

if (isset($_POST["btnRegistreer"])) {
    $username = "";
    $wachtwoord = "";
    $wachtwoordHerhaal = "";

    if (!empty($_POST["txtUsername"])) {
        $username = $_POST["txtUsername"];
    } else {
        $error .= "De gebruikersnaam moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtGeslacht"])) {
        $geslacht = $_POST["txtGeslacht"];
    } else {
        $error .= "Geslacht moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtLeeftijd"])) {
        $leeftijd = $_POST["txtLeeftijd"];
    } else {
        $error .= "Leeftijd moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtRol"])) {
        $rol = $_POST["txtRol"];
    } else {
        $error .= "Rol moet ingevuld worden (admin of user).<br>";
    }

    if (!empty($_POST["txtWachtwoord"]) && !empty($_POST["txtWachtwoordHerhaal"])) {
        $wachtwoord = $_POST["txtWachtwoord"];
        $wachtwoordHerhaal = $_POST["txtWachtwoordHerhaal"];
    } else {
        $error .= "Beide wachtwoordvelden moeten ingevuld worden.<br>";
    }

    if ($_POST["txtRol"] != "admin" && $_POST["txtRol"] != "user") {
        $error .= "Rol moet admin of user zijn.";
    }

    if ($_POST["txtGeslacht"] != "m" && $_POST["txtGeslacht"] != "v" && $_POST["txtGeslacht"] != "x") {
        $error .= "Geslacht moet man, vrouw of x zijn.";
    }

    
    if ($error == "") {
        try {
            $gebruiker = new User();
            $gebruiker->setUserName($username);
            $gebruiker->setGeslacht($geslacht);
            $gebruiker->setLeeftijd($leeftijd);
            $gebruiker->setRol($rol);
            $gebruiker->setWachtwoord($wachtwoord, $wachtwoordHerhaal);
            
            $GebruikerSvc = new UserService();
            $GebruikerSvc->register($gebruiker);
            $_SESSION["gebruiker"] = serialize($gebruiker);
            $_SESSION["username"] = $username;
            $_SESSION["rol"] = $rol;


            $newGebruikerSvc = new UserService();
            $newGebruiker = $newGebruikerSvc->getUserByName($username);
            $userId = $newGebruiker->getUserId();
            $_SESSION["userId"] = $userId;

        } catch (WachtwoordenKomenNietOvereenException $e) {
            $error .= "De ingevulde wachtwoorden komen niet overeen.<br>";
        } catch (GebruikerBestaatAlException $e) {
            $error .= "Er bestaat al een gebruiker met deze gebruikersnaam.<br>";
        }         
    }
}

if ($error == "" && isset($_SESSION["gebruiker"])) {
    header("location: Presentation/viewGegevensAangemaakt.php");
    exit;
} else if ($error != "") {
    echo "<span style=\"color:red;\">" . $error . "</span>";
}

if (!isset($_SESSION["gebruiker"])) {
    include("Presentation/header.php");
    include("Presentation/viewRegistreren.php");
    include("Presentation/footer.php");
}
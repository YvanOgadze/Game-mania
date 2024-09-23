<?php
session_start();
spl_autoload_register();

use Business\UserService;
use Entities\User;

$error = "";
$username = $_SESSION["username"];
$gebruikerSvc = new UserService();
$gebruikerData = $gebruikerSvc->getUserByName($username);
$geslacht = $gebruikerData->getGeslacht();
$leeftijd = $gebruikerData->getLeeftijd();
$rol = $gebruikerData->getRol();

if (isset($_POST["btnUpdate"])) {
    if ($_POST["txtRol"] != "admin" && $_POST["txtRol"] != "user") {
        $error .= "Rol moet admin of user zijn.";
    }

    if ($_POST["txtGeslacht"] != "m" && $_POST["txtGeslacht"] != "v" && $_POST["txtGeslacht"] != "x") {
        $error .= "Geslacht moet man, vrouw of x zijn.";
    }

    if ($error == "") {
        $geslachtNieuw = $_POST["txtGeslacht"];
        $leeftijdNieuw = $_POST["txtLeeftijd"];
        $rolNieuw = $_POST["txtRol"];
            
        $gebruiker = new User();
        $gebruiker->setUserName($username);
        $gebruiker->setGeslacht($geslachtNieuw);
        $gebruiker->setLeeftijd($leeftijdNieuw);
        $gebruiker->setRol($rolNieuw);
            
        $gebruikerDAO = new UserService();
        $gebruikerDAO->updateProfiel($gebruiker);
        $_SESSION["gebruiker"] = serialize($gebruiker);
        $_SESSION["rol"] = $rolNieuw;
        
        header("location: Presentation/viewGegevensGewijzigd.php");
        exit;
    }
}

if ($error != "") {
    echo "<span style=\"color:red;\">" . $error . "</span>";
}

include("Presentation/header.php");
include("Presentation/viewGebruikerUpdate.php");
include("Presentation/footer.php");
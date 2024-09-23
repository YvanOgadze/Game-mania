<?php
session_start();
spl_autoload_register();

use Business\GameService;
use Entities\Game;
use Business\GenreService;
use Business\ConsoleService;

$GenreSvc = new GenreService();
$genreData = $GenreSvc->getGenreLijst();

$ConsoleSvc = new ConsoleService();
$consoleData = $ConsoleSvc->getConsoleLijst();

$error = "";
unset($_SESSION["game"]);

if (isset($_POST["btnToevoegen"])) {
    $genreId = "";
    $consoleId = "";
    $titel = "";
    $omschrijving = "";
    $prijs = "";

    if (!empty($_POST["txtGenreId"]) && ($_POST["txtGenreId"]) != 0) {
        $genreId = $_POST["txtGenreId"];
    } else {
        $error .= "De genre moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtConsoleId"]) && ($_POST["txtConsoleId"]) != 0) {
        $consoleId = $_POST["txtConsoleId"];
    } else {
        $error .= "De console moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtTitel"])) {
                       
        $titel = $_POST["txtTitel"];
    } else {
        $error .= "De titel moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtOmschrijving"])) {
        $omschrijving = $_POST["txtOmschrijving"];
    } else {
        $error .= "De omschrijving moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtPrijs"])) {
        $prijs = $_POST["txtPrijs"];
    } else {
        $error .= "De prijs moet ingevuld worden.<br>";
    }

    if ($error == "") {
        $game = new Game();
        $game->setGenreId($genreId);
        $game->setConsoleId($consoleId);
        $game->setTitel($titel);
        $game->setOmschrijving($omschrijving);
        $game->setPrijs($prijs);
    
        $Gamevc = new GameService();
        $Gamevc->createGame($game);
        $_SESSION["game"] = serialize($game);
        header("location: overzicht.php");
        echo "De game is succesvol toegevoegd.<br>";
        exit;
    }
}

if ($error != "" && isset($_SESSION["game"])) {
    header("location: Presentation/viewGegevensAangemaakt.php");
    exit;
} else if($error != "") {
    echo "<span style=\"color:red;\">" . $error . "</span>";
}

if (!isset($_SESSION["game"])) {
    include "Presentation/header.php";
    include "Presentation/viewGamesToevoegen.php";
    include "Presentation/footer.php";
}


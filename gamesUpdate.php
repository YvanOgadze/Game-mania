<?php
session_start();
spl_autoload_register();

use Business\GameService;
use Business\GenreService;
use Business\ConsoleService;
use Entities\Game;

$error = "";

$gameId = (int)$_GET["gameId"];
$Gamevc = new GameService();
$game = $Gamevc->getGameByGameId($gameId);

$Genrevc = new GenreService();
$genreData = $Genrevc->getGenreLijst();

$Consolevc = new ConsoleService();
$consoleData = $Consolevc->getConsoleLijst();


if (isset($_POST["btnUpdate"])) {
    $titel = "";
    $genreId = "";
    $consoleId = "";
    $prijs = "";
    $omschrijving = "";

    if (!empty($_POST["txtTitel"])) {
        $titel = (string)$_POST["txtTitel"];        
    } else {
        $error .= "De titel moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtGenre"])) {
        $genreId = (int)$_POST["txtGenre"];
    } else {
        $error .= "De genre moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtConsole"])) {
        $consoleId = (int)$_POST["txtConsole"];
    } else {
        $error .= "De console moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtPrijs"])) {
        $prijs = (float)$_POST["txtPrijs"];
    } else {
        $error .= "De prijs moet ingevuld worden.<br>";
    }

    if (!empty($_POST["txtOmschrijving"])) {
        $omschrijving = (string)$_POST["txtOmschrijving"];
    } else {
        $error .= "De omschrijving moet ingevuld worden.<br>";
    }   
   
    if ($error == "") {
        $updatedGame = new Game();
        $updatedGame->setGameId($gameId);
        $updatedGame->setTitel($titel);
        $updatedGame->setGenreId($genreId);
        $updatedGame->setConsoleId($consoleId);
        $updatedGame->setPrijs($prijs);
        $updatedGame->setOmschrijving($omschrijving);
        
        $updateGamevc = new GameService();
        $updateGamevc->updateGame($updatedGame);
        
        header("location: Presentation/viewGegevensGewijzigd.php");
        exit;
    }
}

if ($error != "") {
    echo "<span style=\"color:red;\">" . $error . "</span>";
}

include("Presentation/header.php");
include("Presentation/viewGamesUpdate.php");
include("Presentation/footer.php");
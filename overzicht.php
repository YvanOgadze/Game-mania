<?php
declare(strict_types=1);
session_start();
spl_autoload_register();

use Business\ConsoleService;
use Business\GameService;
use Business\GenreService;

$genreSvc = new GenreService();
$genreLijst = $genreSvc->getGenreLijst();
$keuzeGenre = 0;

$consolesvc = new ConsoleService();
$consoleLijst = $consolesvc->getConsoleLijst();
$consoleLijstKeuze = $consolesvc->getConsoleLijst();

$gameSvc = new GameService();

if (isset($_POST["btnSelecteerConsole"])) {
    $keuzeConsole = (int)$_POST["keuzeConsole"];
    if ($keuzeConsole === 0) {
        $consoleLijst = "";
        $consoleLijst = $consolesvc->getConsoleLijst();
    } else {
        $consoleLijst = "";
        $consoleLijst = $consolesvc->getConsoleById($keuzeConsole);
    }
}

if (isset($_POST["btnSelecteerGenre"])) {
    $keuzeGenre = (int)$_POST["keuzeGenre"];
}

include "Presentation/header.php";
include "Presentation/viewOverzicht.php";
include "Presentation/footer.php";
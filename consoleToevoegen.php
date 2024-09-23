<?php
session_start();
spl_autoload_register();

use Business\ConsoleService;
use Entities\Console;

$error = "";

$consoleSvc = new ConsoleService();
$consoleData = $consoleSvc->getConsoleLijst();

if (isset($_POST["btnToevoegen"])) {
    $consoleNaam = "";
    
    if (!empty($_POST["txtConsoleNaam"])) {
        $consoleNaam = $_POST["txtConsoleNaam"];
    } else {
        $error .= "De console moet ingevuld worden.<br>";
    }

    if ($error == "") {
        $console = new Console();
        $console->setConsole($consoleNaam);
        $Consolevc = new ConsoleService();
        $Consolevc->voegConsoleToe($console);
        header("location: Presentation/viewGegevensAangemaakt.php");
        exit;
    }
}

include "Presentation/header.php";
include "Presentation/viewConsoleToevoegen.php";
include "Presentation/footer.php";
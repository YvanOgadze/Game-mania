<?php
session_start();
spl_autoload_register();

use Business\GameService;

$gameId = (int)$_GET["gameId"];

$gameSvc = new GameService();
$gameSvc->deleteGame($gameId);
echo "Lievelingsgame toegevoegd";
header("location: overzicht.php");

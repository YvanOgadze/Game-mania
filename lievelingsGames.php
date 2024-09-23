<?php
declare(strict_types = 1);
session_start();
spl_autoload_register();

use Business\UserService;
use Business\GameService;
use Business\LievelingsGameService;

$lievelingsGameSvc = new LievelingsGameService();
$lievelingsgameData = $lievelingsGameSvc->getLievelingsGameLijst();
$lieveligsgameDataGame = "";

$gameSvc = new GameService();
$gameLijst = $gameSvc->getGameLijst();

$userSvc = new UserService();


if (isset($_POST["btnGame"])) {
    $gameId = (int)$_POST["txtGame"];
    if ($gameId === 0) {
        $lievelingsgameData = "";
        $lievelingsgameData = $lievelingsGameSvc->getLievelingsGameLijst();
    } else {
        $lievelingsgameData = "";
        $lievelingsgameData = $lievelingsGameSvc->getLievelingsGameByGameId($gameId);
    }
}



include "Presentation/header.php";
include "Presentation/viewLievelingsGames.php";
include "Presentation/footer.php";
<?php
declare(strict_types = 1);
session_start();
spl_autoload_register();

use Business\UserService;
use Entities\User;
use Business\GameService;
use Business\LievelingsGameService;

$gebruikerSvc = new UserService();
$gebruikerData = $gebruikerSvc->getUserByName($_SESSION["username"]);

$gebruiker = new User($gebruikerData->getUserId(), $gebruikerData->getUserName(), $gebruikerData->getGeslacht(), $gebruikerData->getLeeftijd(), $gebruikerData->getRol(), $gebruikerData->getWachtwoord());

$lievelingsGameSvc = new LievelingsGameService();
$lievelingsgameData = $lievelingsGameSvc->getLievelingsGameByUserId($gebruikerData->getUserId());

$gameSvc = new GameService();

include "Presentation/header.php";
include "Presentation/viewGebruikerOverzicht.php";
include "Presentation/footer.php";
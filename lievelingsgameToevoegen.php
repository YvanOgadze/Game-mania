<?php
session_start();
spl_autoload_register();

use Business\LievelingsGameService;
use Business\UserService;

$gameId = (int)$_GET["gameId"];
$username = $_SESSION["username"];

$usernameSvc = new UserService();
$usernameData = $usernameSvc->getUserByName($username);
$userId = $usernameData->getUserId();

$lievelingsgameSvc = new LievelingsGameService();
$lievelingsgameSvc->createLievelingsGame($gameId, $userId);
header("location: overzicht.php");

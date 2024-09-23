<?php
declare(strict_types = 1);
session_start();
spl_autoload_register();

use Business\GameService;
use Business\GenreService;

$gameSvc = new GameService();
$game = $gameSvc->getGameByGameId((int)$_GET["gameId"]);
$genreId = $game->getGenreId();

$genreSvc = new GenreService();
$genre = $genreSvc->getGenreById($genreId);
$genreNaam = $genre->getGenre();

include "Presentation/header.php";
include("presentation/viewGamesDetails.php");
include "Presentation/footer.php";
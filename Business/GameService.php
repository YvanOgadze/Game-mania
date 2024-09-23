<?php
//Service/GameService
declare(strict_types=1);

namespace Business;

use Data\GameDAO;
use Entities\Game;

class GameService {
    public function getGameLijst() : array {
        $gameDAO = new GameDAO();
        $lijst = $gameDAO->getGameLijst();
        return $lijst;
    }
    public function getGameByGameId(int $game_id) : Game {
        $gameDAO = new GameDAO();
        $gameData = $gameDAO->getGameByGameId($game_id);
        $game = new Game((int)$gameData["game_id"], (int)$gameData["genre_id"], (int)$gameData["console_id"], (string)$gameData["titel"], (string)$gameData["omschrijving"], (float)$gameData["prijs"]);
        return $game;
    }
    public function getGameByGenreId(int $genre_id) : array {
        $gameDAO = new GameDAO();
        $lijst = $gameDAO->getGameByGenreId($genre_id);
        return $lijst;
    }
    public function getGameByConsoleId(int $console_id) : array {
        $gameDAO = new GameDAO();
        $lijst = $gameDAO->getGameByConsoleId($console_id);
        return $lijst;
    }
    public function createGame(Game $game) : Game{
        $gameDAO = new GameDAO();
        $gameDAO->createGame($game);
        return $game;
    }
    public function updateGame(Game $game) : Game{
        $gameDAO = new GameDAO();
        $gameDAO->updateGame($game);
        return $game;
    }
    public function deleteGame(int $game_id) {
        $gameDAO = new GameDAO();
        $gameDAO->deleteGame($game_id);
    }
}
<?php
//Data/GenresDAO
declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Game;

class GameDAO {
    public function getGameLijst() : array {
        $sql = "select * from Games";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $resultset = $dbh->query($sql);
        $lijst = array();
        foreach($resultset as $rij) {
            $game = new Game((int)$rij["game_id"], (int)$rij["genre_id"], (int)$rij["console_id"], (string)$rij["titel"], (string)$rij["omschrijving"], (float)$rij["prijs"]);
            array_push($lijst, $game);
        }
        $dbh = null;
        return $lijst;
    }
    public function getGameByGameId(int $game_id) {
        $sql = "select * from Games where game_id = :game_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':game_id' => $game_id));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $rij;
    }
    public function getGameByGenreId(int $genre_id) : array {
        $sql = "select * from Games where genre_id = :genre_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':genre_id' => $genre_id));
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array();
        foreach($resultset as $rij) {
            $game = new Game((int)$rij["game_id"], (int)$rij["genre_id"], (int)$rij["console_id"], (string)$rij["titel"], (string)$rij["omschrijving"], (float)$rij["prijs"]);
            array_push($lijst, $game);
        }
        $dbh = null;
        return $lijst;
    }
    public function getGameByConsoleId(int $console_id) : array {
        $sql = "select * from Games where console_id = :console_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':console_id' => $console_id));
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array();
        foreach($resultset as $rij) {
            $game = new Game((int)$rij["game_id"], (int)$rij["genre_id"], (int)$rij["console_id"], (string)$rij["titel"], (string)$rij["omschrijving"], (float)$rij["prijs"]);
            array_push($lijst, $game);
        }
        $dbh = null;
        return $lijst;
    }
    public function bestaatGameAl(string $titel) : bool {
        $sql = "select count(*) as aantal from Games where titel = :titel";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':titel' => $titel));
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        $aantal = $resultSet['aantal'];
        if ($aantal > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function createGame($game) {
            $sql = "insert into Games (genre_id, console_id, titel, omschrijving, prijs) values (:genre_id, :console_id, :titel, :omschrijving, :prijs)";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':genre_id' => $game->getGenreId(),
                ':console_id' => $game->getConsoleId(),
                ':titel' => $game->GetTitel(),
                ':omschrijving' => $game->getOmschrijving(),
                ':prijs' => $game->getPrijs()
            ));
            $dbh = null;
    }
    public function updateGame($game) {
        $sql = "update Games set genre_id = :genre_id, console_id = :console_id, titel = :titel, omschrijving = :omschrijving, prijs = :prijs where game_id = :game_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':game_id' => $game->getGameId(),
            ':genre_id' => $game->getGenreId(),
            ':console_id' => $game->getConsoleId(),
            ':titel' => $game->getTitel(),
            ':omschrijving' => $game->getOmschrijving(),
            ':prijs' => $game->getPrijs()
        ));
        $dbh = null;
    }
    public function deleteGame(int $game_id) {
        $sql = "delete from Games where game_id = :game_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':game_id' => $game_id));
        $dbh = null;
    }
}
<?php
//Data/LievelingsGameDAO
declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;;
use Entities\LievelingsGame;

class LievelingsGameDAO {
    public function getLievelingsGameLijst() : array {
        $sql = "select * from lievelingsgame";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $resultset = $dbh->query($sql);
        $lijst = array();
        foreach($resultset as $rij) {
            $lievelingsGame = new LievelingsGame((int)$rij["lievelingsgame_id"], (int)$rij["game_id"], (int)$rij["user_id"]);
            array_push($lijst, $lievelingsGame);
        }
        $dbh = null;
        return $lijst;
    }
    public function getLievelingsGameByGameId(int $game_id) : array {
        $sql = "select * from lievelingsgame where game_id = :game_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':game_id' => $game_id));
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array();
        foreach($resultset as $rij) {
            $lievelingsGame = new LievelingsGame((int)$rij["lievelingsgame_id"], (int)$rij["game_id"], (int)$rij["user_id"]);
            array_push($lijst, $lievelingsGame);
        }
        $dbh = null;
        return $lijst;
    }
    public function getLievelingsGameByUserId(int $user_id) : array {
        $sql = "select * from lievelingsgame where user_id = :user_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':user_id' => $user_id));
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array();
        foreach($resultset as $rij) {
            $lievelingsGame = new LievelingsGame((int)$rij["lievelingsgame_id"], (int)$rij["game_id"], (int)$rij["user_id"]);
            array_push($lijst, $lievelingsGame);
        }
        $dbh = null;
        return $lijst;
    }
    public function bestaatLievelingsGameAl(int $game_id, int $user_id) : bool {
        $sql = "select count(*) as aantal from lievelingsgame where game_id = :game_id and user_id = :user_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':game_id' => $game_id, ':user_id' => $user_id));
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        $aantal = $resultSet['aantal'];
        if ($aantal > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function createLievelingsGame(int $game_id, int $user_id) {
        if (!$this->bestaatLievelingsGameAl($game_id, $user_id)) {
            $sql = "insert into lievelingsgame (game_id, user_id) values (:game_id, :user_id)";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
    
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':game_id' => $game_id, ':user_id' => $user_id));
            $dbh = null;     
        }        
    }
    public function deleteLievelingsGame(int $game_id, int $user_id) {
        $sql = "delete from lievelingsgame where where game_id = :game_id and user_id = :user_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':game_id' => $game_id, ':user_id' => $user_id));
        $dbh = null;
    }
}
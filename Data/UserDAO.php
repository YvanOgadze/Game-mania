<?php
//Data/UserDAO.php
declare(strict_types=1);

namespace Data;

use PDO;
use Data\DBConfig;
use Entities\User;
use Exceptions\GebruikerBestaatAlException;
use Exceptions\GebruikerBestaatNietException;
use Exceptions\WachtwoordenKomenNietOvereenException;


class UserDAO {
    public function getAll() : array {
        $sql = "select * from Users";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach($resultSet as $rij) {
            $user = new User((int)$rij["user_id"], (string)$rij["user_name"], (string)$rij["geslacht"], (int)$rij["leeftijd"], (string)$rij["rol"]);
            array_push($lijst, $user);
        }
        $dbh = null;
        return $lijst;
    }
    public function getUserByName(string $username) {
        $sql = "select * from Users where user_name = :username";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':username' => $username));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $rij;
    }
    public function getUserById(int $userId) {
        $sql = "select * from Users where user_id = :userId";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':userId' => $userId));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $rij;
    }
    public function usernameReedsInGebruik(string $username) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare("select * from Users where user_name = :username");
        $stmt->bindValue(":username", $username);
        $stmt->execute();
        $rowcount = $stmt->rowcount();
        $dbh = null;
        return $rowcount;
    }
    public function register($user) {
        $rowcount = $this->usernameReedsInGebruik($user->getUserName());
        if ($rowcount > 0) {
            throw new GebruikerBestaatAlException();
        }
        $sql = "insert into Users (user_name, geslacht, leeftijd, rol, wachtwoord) values (:username, :geslacht, :leeftijd, :rol, :wachtwoord)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ":username" => $user->getUserName(),
            ":geslacht" => $user->getGeslacht(),
            ":leeftijd" => $user->getLeeftijd(),
            ":rol" => $user->getRol(),
            ":wachtwoord" => $user->getWachtwoord(),
        ));
        $dbh = null;
    }
    public function login($user) {
        $rowcount = $this->usernameReedsInGebruik($user->getUserName());
        if ($rowcount == 0) {
            throw new GebruikerBestaatNietException();
        }

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("select user_id, wachtwoord from Users where user_name = :username");
        $stmt->bindValue(":username", $user->getUserName());
        $stmt->execute();
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $isWachtwoordCorrect = password_verify($user->getWachtwoord(), $resultSet["wachtwoord"]);
        
        if (!$isWachtwoordCorrect) {
            throw new WachtwoordenKomenNietOvereenException();
        }

        $dbh = null;
        return $resultSet;
    }
    public function updateProfiel($user) {
        $sql = "update Users set geslacht = :geslacht, leeftijd = :leeftijd, rol = :rol where user_name = :username";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ":geslacht" => $user->getGeslacht(), 
            ":leeftijd" => $user->getLeeftijd(), 
            ":rol" => $user->getRol(), 
            ":username" => $user->getUserName()));
        $dbh = null;
    }
    public function updateWachtwoord($user) {
        $sql = "update Users set wachtwoord = :wachtwoord where user_name = :username";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ":wachtwoord" => $user->getWachtwoord(), 
            ":username" => $user->getUserName()));
        $dbh = null;
    }
}

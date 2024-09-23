<?php
//entities/User.php
declare(strict_types= 1);

namespace Entities;
use Exceptions\WachtwoordenKomenNietOvereenException;

class User {
    private static $idMap = array();
    private $user_id;
    private $user_name;
    private $geslacht;
    private $leeftijd;
    private $rol;
    private $wachtwoord;
    //Constructor
    public function __construct($cuser_id = null, $cuser_name = null, $cgeslacht = null, $cleeftijd = null, $crol = null, $cwachtwoord = null) {
        $this->user_id = $cuser_id;
        $this->user_name = $cuser_name;
        $this->geslacht = $cgeslacht;
        $this->leeftijd = $cleeftijd;
        $this->rol = $crol;
        $this->wachtwoord = $cwachtwoord;        
    }
    //Getters
    public function getUserId() {
        return $this->user_id;
    }
    public function getUserName() {
        return $this->user_name;
    }
    public function getGeslacht() {
        return $this->geslacht;
    }
    public function getLeeftijd() {
        return $this->leeftijd;
    }
    public function getRol() {
        return $this->rol;
    }
    public function getWachtwoord() {        
        return $this->wachtwoord;
    }
    //Setters
    public function setUserName($user_name) {
        $this->user_name = $user_name;
    }
    public function setGeslacht($geslacht) {
        $this->geslacht = $geslacht;
    }
    public function setLeeftijd($leeftijd) {
        $this->leeftijd = $leeftijd;
    }
    public function setRol($rol) {
        $this->rol = $rol;
    }
    public function setWachtwoord($wachtwoord, $herhaalWachtwoord) {
        if ($wachtwoord !== $herhaalWachtwoord) {
            throw new WachtwoordenKomenNietOvereenException();
        }
        $this->wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
    }
    public static function create(int $user_id, string $user_name, string $geslacht, int $leeftijd, string $rol, string $wachtwoord) {
        if (!isset(self::$idMap[$user_id])) {
            self::$idMap[$user_id] = new User($user_id, $user_name, $geslacht, $leeftijd, $rol, $wachtwoord);
        }
        return self::$idMap[$user_id];
    }
}
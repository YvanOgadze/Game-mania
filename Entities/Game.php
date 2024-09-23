<?php
//Entities/Game.php
declare(strict_types=1);

namespace Entities;

class Game {
    private static $idMap = array();
    private $game_id;
    private $genre_id;
    private $console_id;
    private $titel;
    private $omschrijving;
    private $prijs;
    //Constructor
    public function __construct($cgame_id = null, $cgenre_id = null, $cconsole_id = null, $ctitel = null, $comschrijving = null, $cprijs = null) {
        $this->game_id = $cgame_id;
        $this->genre_id = $cgenre_id;
        $this->console_id = $cconsole_id;
        $this->titel = $ctitel;
        $this->omschrijving = $comschrijving;
        $this->prijs = $cprijs;
    }
    //Getters
    public function getGameId() : int {
        return $this->game_id;
    }
    public function getGenreId() : int {
        return $this->genre_id;
    }
    public function getConsoleId() : int {
        return $this->console_id;
    }
    public function getTitel() : string {
        return $this->titel;
    }
    public function getOmschrijving() : string {
        return $this->omschrijving;
    }
    public function getPrijs() : float {
        return $this->prijs;
    }
    //Setters
    public function setGenreId(int $genre_id) {
        $this->genre_id = $genre_id;
    }
    public function setGameId(int $game_id) {
        $this->game_id = $game_id;
    }
    public function setConsoleId(int $console_id) {
        $this->console_id = $console_id;
    }
    public function setTitel(string $titel) {
        $this->titel = $titel;
    }
    public function setOmschrijving(string $omschrijving) {
        $this->omschrijving = $omschrijving;
    }
    public function setPrijs(float $prijs) {
        $this->prijs = $prijs;
    }
    public static function create(int $game_id, int $genre_id, int $console_id, string $titel, string $omschrijving, float $prijs) {
        if (!isset(self::$idMap[$game_id])) {
            self::$idMap[$game_id] = new Game($game_id, $genre_id, $console_id, $titel, $omschrijving, $prijs);
        }
        return self::$idMap[$game_id];
    }
}
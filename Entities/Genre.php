<?php
//Entities/Genre.php
declare(strict_types=1);

namespace Entities;

class Genre {
    private static $idMap = array();
    private $genre_id;
    private $genre;
    //Constructor
    public function __construct($cgenre_id = null, $cgenre = null) {
        $this->genre_id = $cgenre_id;
        $this->genre = $cgenre;
    }
    //Getters
    public function getGenreId() : int {
        return $this->genre_id;
    }
    public function getGenre() : string {
        return $this->genre;
    }
    //Setters
    public function setGenreId(int $genre_id) {
        $this->genre_id = $genre_id;
    }
    public function setGenre(string $genre) {
        $this->genre = $genre;
    }
    public static function create(int $genre_id, string $genre) {
        if (!isset(self::$idMap[$genre_id])) {
            self::$idMap[$genre_id] = new Genre($genre_id, $genre);
        }
        return self::$idMap[$genre_id];
    }
}
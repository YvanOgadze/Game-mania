<?php
//Data/GenreDAO
declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Genre;

class GenreDAO {
    public function getGenreLijst() {
        $sql = "select genre_id, genre from Genres";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $resultset = $dbh->query($sql);
        $lijst = array();
        foreach($resultset as $rij) {
            $genre = new Genre((int)$rij["genre_id"], (string)$rij["genre"]);
            array_push($lijst, $genre);
        }
        $dbh = null;
        return $lijst;
    }
    public function getGenreById(int $genre_id) : array {
        $sql = "select genre_id, genre from Genres where genre_id = :genre_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':genre_id' => $genre_id));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $rij;
    }
    public function bestaatGenreAl(string $genre) : bool {
        $sql = "select count(*) as aantal from Genres where genre = :genre";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':genre' => $genre));
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        $aantal = $resultSet['aantal'];
        if ($aantal > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function createGenre($genre) {
        if (!$this->bestaatGenreAl($genre->getGenre())) {
            $sql = "insert into Genres (genre) values (:genre)";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':genre' => $genre->getGenre()
            ));
            $dbh = null;
        }
    }
}
<?php
//Business/GenreService
declare(strict_types=1);

namespace Business;

use Data\GenreDAO;
use Entities\Genre;

class GenreService {
    public function getGenreLijst() : array {
        $genreDAO = new GenreDAO();
        $lijst = $genreDAO->getGenreLijst();
        return $lijst;
    }
    public function getGenreById(int $genre_id) : Genre {
        $genreDAO = new GenreDAO();
        $genreData = $genreDAO->getGenreById($genre_id);
        $genre = new Genre((int)$genreData["genre_id"], (string)$genreData["genre"]);
        return $genre;
    }
    public function voegGenreToe(Genre $genre) : Genre{
        $genreDAO = new GenreDAO();
        $genreDAO->createGenre($genre);
        return $genre;
    }
}
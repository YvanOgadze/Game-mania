<?php
session_start();
spl_autoload_register();

use Business\GenreService;
use Entities\Genre;

$error = "";

$genreSvc = new GenreService();
$genreData = $genreSvc->getGenreLijst();

if (isset($_POST["btnToevoegen"])) {
    $genreNaam = "";

    if (!empty($_POST["txtGenreNaam"])) {
        $genreNaam = $_POST["txtGenreNaam"];
    } else {
        $error .= "De genre moet ingevuld worden.<br>";
    }

    if ($error == "") {
        $genre = new Genre();
        $genre->setGenre($genreNaam);
        $Genrevc = new GenreService();
        $Genrevc->voegGenreToe($genre);
        header("location: Presentation/viewGegevensAangemaakt.php");
        exit;
    }
}

include "Presentation/header.php";
include "Presentation/viewGenreToevoegen.php";
include "Presentation/footer.php";
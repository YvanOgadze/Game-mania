<h1>Nieuwe genre toevoegen</h1>

<?php
foreach ($genreData as $genre) {
    echo $genre->getGenre() . "<br>";
}
?>
<br>
<br>

<form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
    <div>Naam van de nieuwe genre: <input type="text" name="txtGenreNaam"></div>
<input type="submit" value="Toevoegen" name="btnToevoegen">
</form>


<div><a href="overzicht.php">Terug naar home pagina</a></div>

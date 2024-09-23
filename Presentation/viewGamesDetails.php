<h1><?php echo ($game->getTitel()); ?></h1>

<h2>Prijs:</h2>
<p><?php echo ($game->getPrijs()) . " euro"; ?></p>

<h2>Genre:</h2>
<p><?php echo $genreNaam ?></p>
<h2>Omschrijving:</h2>
<p><?php echo ($game->getOmschrijving()); ?></p>

<br>
<?php
if (isset($_SESSION["gebruiker"])) {
    ?>
    <?php echo ($game->getTitel()); ?> <a href="gamesUpdate.php?gameId=<?php echo ($game->getGameId()) ?>">bewerken</a><br>
    <?php echo ($game->getTitel()); ?> toevoegen als<a href="lievelingsgameToevoegen.php?gameId=<?php echo ($game->getGameId()) ?>?userId=<?php echo $_SESSION["username"] ?>"> lievelingsgame</a><br>
    <?php
}
if (isset($_SESSION["gebruiker"]) && $_SESSION["rol"] == "admin") {
    ?>
    <?php echo ($game->getTitel()); ?> <a href="gamesVerwijderen.php?gameId=<?php echo ($game->getGameId()) ?>">verwijderen</a>
    <?php
}
?>    

<br>
<br>
Terug naar <a href="overzicht.php">home pagina</a></a>
<br>
<br>
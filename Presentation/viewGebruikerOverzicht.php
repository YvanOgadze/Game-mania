<h1>Username: <?php echo($gebruiker->getUserName()); ?></h1>

<p>geslacht: <?php echo($gebruiker->getGeslacht()); ?></p>
<p>Leeftijd: <?php echo($gebruiker->getLeeftijd()); ?></p>
<p>Rol: <?php echo($gebruiker->getRol()); ?></p>
<br>

<p>Lievelingsgames: </p>
<?php

if (count($lievelingsgameData) == 0) {
    echo "geen lievelingsgames gevonden <br>";
} else {
    foreach ($lievelingsgameData as $lievelingsgame) {
        $lievelingsgameGame = $lievelingsgame->getGameId();
    
        $game = $gameSvc->getGameByGameId($lievelingsgameGame);
        $gameTitel = $game->getTitel();
        $gameOmschrijving = $game->getOmschrijving();
        $gamePrijs = $game->getPrijs();
    
        echo "game titel: " . $gameTitel;
        echo "<br>";
        echo "game omschrijving: " . $gameOmschrijving;
        echo "<br>";
        echo "game prijs: " . $gamePrijs;
        echo "<br>";
        echo "<br>";
    }
}
?>

<br>
Terug naar <a href="overzicht.php">home pagina</a></a>
<br>
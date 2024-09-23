<h1><?php echo ($game->getTitel()); ?></h1>

<h2>Bewerk hieronder de game</h2>



<form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>?gameId=<?php echo $gameId?>" method="POST">
    Titel: <input type="text" name="txtTitel" value="<?php echo $game->getTitel(); ?>"><br>
    
    Genre: 
    <select name="txtGenre">
        <option value="0">---Selecteer een genre---</option>
        <?php
        foreach ($genreData as $genre) {
            echo "<option value=" . $genre->getGenreId() . ">" . $genre->getGenre() . "</option>";
        }
        ?>
    </select><br>
    <input type="hidden" name="txtGameId" value="<?php echo $game->getGameId(); ?>">
    Console:
    <select name="txtConsole">
    <option value="0">---Selecteer een console---</option>
        <?php
        foreach ($consoleData as $console) {
            echo "<option value=" . $console->getConsoleId() . ">" . $console->getConsole() . "</option>";
        }
        ?>
    </select><br>

    Prijs: € <input type="number" step="0.01" min="0.01" name="txtPrijs" value="<?php echo $game->getPrijs(); ?>"><br>
    Omschrijving: <input type="text" name="txtOmschrijving" value="<?php echo $game->getOmschrijving(); ?>"><br>

    <input type="submit" value="Wijzig game" name="btnUpdate">

</form>

<br>
Terug naar <a href="gamesDetails.php?gameId=<?php print($gameId); ?>">detailpagina</a> 
<br>
Terug naar <a href="overzicht.php">home pagina</a></a>
<br>
<br>
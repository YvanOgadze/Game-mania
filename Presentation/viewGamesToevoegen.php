<h1>Nieuwe game toevoegen</h1>

<form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="Post">
    Titel: <input type="text" name="txtTitel"><br>

    Genre:
    <select name="txtGenreId">
        <option value="0">---Selecteer een genre---</option>
        <?php
        foreach ($genreData as $genre) {
            echo "<option value=" . $genre->getGenreId() . ">" . $genre->getGenre() . "</option>";
        }
        ?>
    </select><br>

    Console:
    <select name="txtConsoleId">
        <option value="0">---Selecteer een console---</option>
        <?php
        foreach ($consoleData as $console) {
            echo "<option value=" . $console->getConsoleId() . ">" . $console->getConsole() . "</option>";
        }
        ?>
    </select><br>

    Prijs: <input type="number" step="0.01" min="0.01" name="txtPrijs"><br>
    Omschrijving: <input type="text" name="txtOmschrijving"><br>
    <input type="submit" value="Toevoegen" name="btnToevoegen">
</form>
<br>
<br>
<a href="overzicht.php">Terug naar home pagina</a>
<br>
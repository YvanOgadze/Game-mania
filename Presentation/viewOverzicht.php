    <h1>GAME MANIA</h1>

    <?php if (isset($_SESSION["gebruiker"])) {
    ?>
        Welkom <?php echo $_SESSION["username"];
            }
    ?>

    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        Filter op console:
        <select name="keuzeConsole">
            <option value="0">--- Alle consoles ---</option>
            <?php
            foreach ($consoleLijstKeuze as $console) {
                echo "<option value=" . $console->getConsoleId() . ">" . $console->getConsole() . "</option>";
            }
            ?>
        </select>

        <input type="submit" name="btnSelecteerConsole" value="Selecteer">
    </form>

    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        Filter op genre:
        <select name="keuzeGenre">
            <option value="0">--- Alle genres ---</option>
            <?php
            foreach ($genreLijst as $genre) {
                echo "<option value=" . $genre->getGenreId() . ">" . $genre->getGenre() . "</option>";
            }
            ?>
        </select>

        <input type="submit" name="btnSelecteerGenre" value="Selecteer">
    </form>

    <ul>
        <?php
        foreach ($consoleLijst as $console) {
            $consoleId = $console->getConsoleId();
            $consoleNaam = $console->getConsole();
        ?> 
        <h2><?php echo $consoleNaam;?> </h2> 
        <?php
            $gameConsole = $gameSvc->getGameByConsoleId($consoleId);
            if ($keuzeGenre == 0) {
                foreach ($gameConsole as $game) {
                    $gameTitel = $game->getTitel();
                    $gameId = $game->getGameId();
                    ?>
                    <li>
                        <a href="gamesDetails.php?gameId=<?php print($gameId); ?>"><?php echo $gameTitel; ?></a>
                    </li>
                    <?php
                }
            } else {
                foreach ($gameConsole as $game) {
                    if ($keuzeGenre == $game->getGenreId()) {
                        $gameTitel = $game->getTitel();
                        $gameId = $game->getGameId();
                        ?>
                        <li>
                            <a href="gamesDetails.php?gameId=<?php print($gameId); ?>"><?php echo $gameTitel; ?></a>
                        </li> <?php
                    }
                }
            }
        }
    ?>
    </ul>

    <?php

    if (isset($_SESSION["gebruiker"]) && $_SESSION["rol"] == "admin") {
    ?>  <div><a href="gamesToevoegen.php">Game toevoegen</a></div>
        <div><a href="consoleToevoegen.php">Console toevoegen</a></div>
        <div><a href="genreToevoegen.php">Genre toevoegen</a></div>
    <?php
    }
    ?>
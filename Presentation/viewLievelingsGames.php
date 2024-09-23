<h1>Lievelings games</h1>
<form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
    Filter op games:
    <select name="txtGame">
        <option value="0">--- Alle games ---</option>
        <?php
        
        foreach ($gameLijst as $game) {
            $gameTitel = $game->getTitel();
            echo "<option value=" . $game->getGameId() . ">" . $gameTitel . "</option>";
        }
        ?>
    </select>

    <input type="submit" name="btnGame" value="Selecteer">
</form>

<ul>
    <?php
        if (count($lievelingsgameData) == 0) {
            echo "geen lievelingsgames gevonden <br>";
        } else {
            foreach ($lievelingsgameData as $lievelingsgame) {
                $gameData = $gameSvc->getGameByGameId($lievelingsgame->getGameId());
                $userData = $userSvc->getUserByUserId($lievelingsgame->getUserId());
        
                $gameTitel = $gameData->getTitel();
                $username = $userData->getUserName();
                $geslacht = $userData->getGeslacht();
                $leeftijd = $userData->getLeeftijd();    
        
                echo "<li>Game: " . $gameTitel . " <br>Username: " . $username . ", geslacht: " . $geslacht . ", leeftijd: " . $leeftijd . "</li><br>";
            }
        }

    ?>
</ul>
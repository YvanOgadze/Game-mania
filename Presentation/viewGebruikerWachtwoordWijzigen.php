<h1>Wachtwoord wijzigen</h1>
<h2>
    Username: 
    <?php
    echo $username
    ?>
</h2>
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        </select><br>
        Nieuw Wachtwoord: <input type="password" name="txtWachtwoord"><br>
        Herhaal Wachtwoord: <input type="password" name="txtWachtwoordHerhaal"><br>
        <input type="submit" value="Wijzig profiel" name="btnUpdate">   
    </form>
    
    <br><br>
    Terug naar <a href="overzicht.php">home pagina</a>
    <br><br>


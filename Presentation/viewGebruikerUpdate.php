<h1>Profiel wijzigen</h1>
<h2>
    Username: 
    <?php
    echo $username
    ?>
</h2>
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        Geslacht:     
        <select name="txtGeslacht">
            <option value="m">man</option>
            <option value="v">vrouw</option>
            <option value="x">x</option>
        </select><br>
        Leeftijd: <input type="number" name="txtLeeftijd" value="<?php echo $leeftijd; ?>"><br>
        Rol:     
        <select name="txtRol">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select><br>
        <input type="submit" value="Wijzig profiel" name="btnUpdate">   
    </form>
    
    <br><br>
    Terug naar <a href="overzicht.php">home pagina</a>
    <br>


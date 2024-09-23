<h1>Registreren</h1>

<form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
    <div>Username: <input type="text" name="txtUsername"></div>
    <div>Geslacht (m/v/x): 
    <select name="txtGeslacht">
        <option value="m">Man</option>
        <option value="v">Vrouw</option>
        <option value="x">x</option>
    </select></div>
    <div>Leeftijd: <input type="number" name="txtLeeftijd"></div>
    <div>Rol: 
    <select name="txtRol">
        <option value="user">user</option>
        <option value="admin">admin</option>
    </select></div>
    <div>Wachtwoord: <input type="password" name="txtWachtwoord"></div>
    <div>Herhaal wachtwoord: <input type="password" name="txtWachtwoordHerhaal"></div>
    <input type="submit" value="Registreren" name="btnRegistreer">
    <div><a href="overzicht.php">Terug naar home pagina</a></div>
    
    
</form>
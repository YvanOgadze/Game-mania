<h1>Login</h1>
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div>Username: <input type="text" name="txtUsername"></div>
        <div>Wachtwoord: <input type="password" name="txtWachtwoord"></div>
        <div><input type="submit" name="btnLogin" value="Inloggen"></div>
    </form>

<div>Niewe gebruiker? Klik <a href="registreren.php">hier</a> om te registreren</div>
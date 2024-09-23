<h1>Nieuwe console toevoegen</h1>

<?php
foreach ($consoleData as $console) {
    echo $console->getConsole() . "<br>";
}
?>
<br>
<br>

<form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
    Naam van de nieuwe console: <input type="text" name="txtConsoleNaam"><br>
<input type="submit" value="Toevoegen" name="btnToevoegen">
</form>

<br>
<br>
<a href="overzicht.php">Terug naar home pagina</a>
<br>
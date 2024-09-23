<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <title>Game Mania</title>
  <link rel="stylesheet" href="Opmaak/eindtest.css">
</head>

<body>
  <nav id="nav">
    <a href="overzicht.php">Home</a>
    - <a href="lievelingsGames.php">Lievelings Games</a>
    <?php if (!isset($_SESSION["gebruiker"])) {
    ?>
      - <a href="login.php">Inloggen</a>
      - <a href="registreren.php">Registreren</a>
    <?php
    } else {
    ?>
      - <a href="gebruikerOverzicht.php">Profiel bekijken</a>
      - <a href="gebruikerUpdate.php">Profiel bewerken</a>
      - <a href="gebruikerWachtwoordWijzigen.php">Wachtwoord wijzigen</a>
      - <a href="logout.php"> Uitloggen</a>
    <?php
    }
    ?>
  </nav>
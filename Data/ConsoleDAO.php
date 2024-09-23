<?php
//Data/ConsoleDAO
declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Console;

class ConsoleDAO {
    public function getConsoleLijst()  {
        $sql = "select console_id, console_naam from Consoles";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $resultset = $dbh->query($sql);
        $lijst = array();
        foreach ($resultset as $rij) {
            $console = new Console((int)$rij["console_id"], (string)$rij["console_naam"]);
            array_push($lijst, $console);
        }
        $dbh = null;
        return $lijst;
    }
    public function getConsoleById(int $console_id) : array {
        $sql = "select console_id, console_naam from Consoles where console_id = :console_id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':console_id' => $console_id));
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array();
        foreach($resultset as $rij) {
            $console = new Console((int)$rij["console_id"], (string)$rij["console_naam"]);
            array_push($lijst, $console);
        }
        $dbh = null;
        
        return $lijst;
    }
    public function bestaatConsoleAl(string $console_naam) : bool {
        $sql = "select count(*) as aantal from Consoles where console_naam = :console_naam";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':console_naam' => $console_naam));
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        $aantal = $resultSet['aantal'];
        if ($aantal > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function createConsole($console) {
        if (!$this->bestaatConsoleAl($console->getConsole())) {
            $sql = "insert into Consoles (console_naam) values (:console_naam)";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':console_naam' => $console->getConsole()
            ));
            $dbh = null;
        }
    }
}
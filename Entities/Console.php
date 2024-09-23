<?php
//Entities/Console.php
declare(strict_types=1);

namespace Entities;

class Console {
    private static $idMap = array();
    private $console_id;
    private $console;
    //Constructor
    public function __construct($cconsole_id = null, $cconsole = null) {
        $this->console_id = $cconsole_id;
        $this->console = $cconsole;
    }
    //Getters
    public function getConsoleId() : int {
        return $this->console_id;
    }
    public function getConsole() : string {
        return $this->console;
    }
    //Setters
    public function setConsoleId(int $console_id) {
        $this->console_id = $console_id;
    }
    public function setConsole(string $console) {
        $this->console = $console;
    }
    public static function create(int $console_id, string $console) {
        if (!isset(self::$idMap[$console_id])) {
            self::$idMap[$console_id] = new Console($console_id, $console);
        }
        return self::$idMap[$console_id];
    }
}
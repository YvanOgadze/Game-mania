<?php
//Business/ConsoleService
declare(strict_types=1);

namespace Business;

use Data\ConsoleDAO;
use Entities\Console;

class ConsoleService {
    public function getConsoleLijst() : array {
        $consoleDAO = new ConsoleDAO();
        $lijst = $consoleDAO->getConsoleLijst();
        return $lijst;
    }
    public function getConsoleById(int $console_id) : array {
        $consoleDAO = new ConsoleDAO();
        $lijst = $consoleDAO->getConsoleById($console_id);
        return $lijst;
    }
    public function voegConsoleToe(Console $console) : Console {
        $consoleDAO = new ConsoleDAO();
        $consoleDAO->createConsole($console);
        return $console;
    }
}
<?php

declare(strict_types=1);

namespace App\PruebaPracticaStartup\Interfaces;

use PDO;

interface ConnectionInterface {
    public function createConnection(): void;

    public function closeConnection(): void;
    
    public function executeQuery($query): object;
}


<?php

declare(strict_types=1);

namespace App\PruebaPracticaStartup\Interfaces;

use PDO;

interface Connection {
    public function createConnection($DBEngine): PDO;
}


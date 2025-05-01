<?php

declare(strict_types=1);

namespace App\PruebaPracticaStartup\Classes;

use App\PruebaPracticaStartup\Classes\DBConnectionMysql;

class DBConnection
{
    public $connection;

    public function __construct()
    {
        $this->createConnection();
    }

    private function createConnection(): void
    {
        switch ($_ENV['DB_ENGINE']) {
            case 'mssql':
                # TODO Create connection with MSSQL
                break;
            case 'postgres':
                # TODO Create connection with POSTGRES
                break;
            case 'mysql':
            default:
                $this->connection = new DBConnectionMysql(
                    $_ENV['DB_HOST'],
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASS'],
                    $_ENV['DB_NAME'],
                );
                break;
        }
    }
}
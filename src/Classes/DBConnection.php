<?php

namespace App\PruebaPracticaStartup\Classes;

use App\PruebaPracticaStartup\Classes\DBConnectionMysql;

/**
 * Class DBConnection
 * @package App\PruebaPracticaStartup\Classes
 *
 * This class is responsible for creating a connection to the database.
 */
class DBConnection
{
    
    public $connection;

    /**
     * DBConnection constructor.
     */
    public function __construct()
    {
        $this->createConnection();
    }

    /**
     * Create a connection to the database based on the specified DB engine.
     *
     * @return void
     */
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
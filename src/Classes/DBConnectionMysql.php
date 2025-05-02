<?php

namespace App\PruebaPracticaStartup\Classes;

use App\PruebaPracticaStartup\Interfaces\ConnectionInterface;
use App\PruebaPracticaStartup\Views\Publisher;
use PDO;
use PDOException;
use Exception;

/**
 * Class DBConnectionMysql
 * @package App\PruebaPracticaStartup\Classes
 */
class DBConnectionMysql implements ConnectionInterface
{
    /**
     * @var string Hostname of the database server.
     */
    private $dbHost;
    /**
     * @var string Username of the database server.
     */
    private $dbUser;
    /**
     * @var string Password of the database server.
     */
    private $dbPass;
    /**
     * @var string Database name.
     */
    private $dbName;
    /**
     * @var PDO Database connection.
     */
    private $dbConnection;

    /**
     * DBConnectionMysql constructor.
     * @param string $dbHost Hostname of the database server.
     * @param string $dbName Name of the database server
     * @param string $dbUser Username of the database server.
     * @param string $dbPass Password of Username of the database server.
     */
    public function __construct($dbHost, $dbUser, $dbPass, $dbName)
    {
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
    }

    /**
     * Create a connection to the database.
     * @return bool True if the connection is successful, false otherwise.
     */
    public function createConnection(): bool
    {
        try {
            $host = $this->dbHost;
            $db = $this->dbName;
            $user = $this->dbUser;
            $pass = $this->dbPass;

            $dsn = 'mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->dbConnection = new PDO($dsn, $user, $pass, $options);
            return true;
        } catch (PDOException $exception) {
            $publisher = new Publisher();
            $publisher->showMessage([
                'type' => 'error',
                'title' => 'Error en Connection a DB',
                'message' => $exception->getMessage()
            ]);
            die();
        }
    }

    /**
     * Close the database connection.
     * @return void
     */
    public function closeConnection(): void
    {
        $this->dbConnection = null;
    }

    /**
     * Execute a query on the database.
     * @param string $query Query to execute.
     * @return object Result of the query.
     */
    public function executeQuery($query): object
    {
        try {
            $this->createConnection();
            $result = $this->dbConnection->query($query);
            $this->closeConnection();
        } catch (Exception $exception) {
            $publisher = new Publisher();
            $publisher->showMessage([
                'type' => 'error',
                'title' => 'Error al ejecutar query',
                'message' => $exception->getMessage()
            ]);
            die();
        }
        return $result;
    }

    /**
     * Install the database tables and insert data.
     * @param bool $insterData Whether to insert data or not.
     * @return bool True if the installation is successful, false otherwise.
     */
    public function installTables(bool $insterData = true): bool
    {
        try {
            $this->createConnection();
            $query = file_get_contents(__DIR__ . '/../../data/createTables.sql');
            $this->dbConnection->exec($query);
            $this->closeConnection();
            if ($insterData) {
                $this->createConnection();
                $query = file_get_contents(__DIR__ . '/../../data/insertTable.sql');
                $this->dbConnection->exec($query);
                $this->closeConnection();
            }
        } catch (Exception $exception) {
            $publisher = new Publisher();
            $publisher->showMessage([
                'type' => 'error',
                'title' => 'Error al ejecutar creacion e insercion de datos a la tabla',
                'message' => $exception->getMessage()
            ]);
            die();
        }
        return true;
    }
}

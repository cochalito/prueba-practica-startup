<?php   

declare(strict_types=1);

namespace App\PruebaPracticaStartup\Classes;

use App\PruebaPracticaStartup\Interfaces\ConnectionInterface;
use App\PruebaPracticaStartup\Views\Publisher;
use PDO;
use PDOException;
use Exception;


class DBConnectionMysql implements ConnectionInterface
{
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;
    private $dbConnection;

    private $connectionErrorMessage;

    public function __construct($dbHost, $dbUser, $dbPass, $dbName)
    {
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
    }

    public function createConnection(): bool
    {
        $host = $this->dbHost;
        $db = $this->dbName;
        $user = $this->dbUser;
        $pass = $this->dbPass;

        try {
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
            $publisher->showView('error', [
                'title' => 'Error en Connection a DB',
                'message' => $exception->getMessage()]
            );
            die();
        }
    }

    public function closeConnection(): void
    {
        $this->dbConnection = null;
    }

    public function executeQuery($query): object
    {
        $this->createConnection();
        $result = $this->dbConnection->query($query);
        $this->closeConnection();
        return $result;
    }

    public function installTables(bool $insterData = true): bool
    {
        try {
            $this->createConnection();
            //die(__DIR__ . '/../../data/createTables.sql');
            //$query = file_get_contents(__DIR__ . '/../../data/createTables.sql');
            //$this->dbConnection->exec($query);
            if ($insterData) {
                $query = file_get_contents(__DIR__ . '/../../data/insertTable.sql');
                $this->dbConnection->exec($query);
            }
        } catch (Exception $exception) {
            $publisher = new Publisher();
            $publisher->showView('error', [
                'title' => 'Error al ejecutar creacion e insercion de datos a la tabla',
                'message' => $exception->getMessage()]
            );
            die();
        }
        return true;
    }
}
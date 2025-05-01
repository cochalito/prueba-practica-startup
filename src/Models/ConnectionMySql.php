<?php   

declare(strict_types=1);

namespace App\PruebaPracticaStartup\Models;

use App\PruebaPracticaStartup\Interfaces\ConnectionInterface;
use PDO;
use PDOException;

class ConnectionMySql implements ConnectionInterface
{
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;
    private $dbConnection;

    public function __construct($dbHost, $dbUser, $dbPass, $dbName)
    {
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
    }

    public function createConnection(): void
    {
        $host = $this->dbHost;
        $db = $this->dbHost;
        $user = $this->dbPass;
        $pass = $this->dbName;

        try {
            $dsn = 'mysql:host=' . $host . ';dbname= ' . $db . ';charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->dbConnection = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            //throw new PDOException($e->getMessage(), (int)$e->getCode());
            die('Error de conexion: ' . $e->getMessage());
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
}
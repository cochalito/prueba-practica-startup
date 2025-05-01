<?php   

declare(strict_types=1);

namespace App\PruebaPracticaStartup\Models;

use App\PruebaPracticaStartup\Classes\DBConnection;
use App\PruebaPracticaStartup\Classes\Model;
use Exception;
use PDOStatement;

class ResourcesModel extends Model
{
    protected $tableName = 'resources';
    private $connection;

    public function __construct() {
        $this->connection = new DBConnection()->connection;
        
    }

    public function searchByName(string $filter, int $start = 0, int $limit = 10): PDOStatement
    {
        try {
            $query = 'SELECT 
                id, 
                type,
                name,
                value
            FROM
                resources
            WHERE
                name LIKE "%' . $filter . '%"
                AND status = 1
            LIMIT ' . $start . ',' . $limit;
            $result = $this->connection->executeQuery($query);
            return $result;
        } catch (Exception $exception) {
            die('Error :' . $exception->getMessage());
        }
    }
}
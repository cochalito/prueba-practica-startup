<?php

namespace App\PruebaPracticaStartup\Models;

use App\PruebaPracticaStartup\Classes\DBConnection;
use App\PruebaPracticaStartup\Models\Model;
use Exception;

/**
 * Class ResourcesModel
 * @package App\PruebaPracticaStartup\Models
 *
 * This class is responsible for handling resource-related database operations.
 */
class ResourcesModel extends Model
{
    /**
     * @var string Table name for the resources.
     */
    protected $tableName = 'resources';

    /**
     * @var DBConnection Database connection instance.
     */
    private $connection;

    /**
     * ResourcesModel constructor.
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->connection = new DBConnection()->connection;
    }

    /**
     * Searches for resources by name.
     *
     * @param string $filter The filter string to search for resources.
     * @param int $start The starting index for pagination.
     * @param int $limit The number of results to return.
     * @return array An array containing the search results and metadata.
     */
    public function searchByName(string $filter, int $start = 0, int $limit = 10): array
    {
        try {
            $dataResult = [];
            $querySelectPart = 'SELECT id, type, name, value';
            $queryFromPart = 'FROM resources';
            $queryWherePart = 'WHERE name LIKE "%' . $filter . '%" AND status = 1';
            $queryLimitPart = 'LIMIT ' . $start . ',' . $limit;
            
            $queryCount = 'SELECT COUNT(*) as total ' . $queryFromPart . ' ' . $queryWherePart;
            $resultCount = $this->connection->executeQuery($queryCount);
            $total = $resultCount->fetch()['total'];

            $dataResult['total'] = $total;
            $dataResult['start'] = $start+1;
            $dataResult['limit'] = $limit;
            $dataResult['filter'] = $filter;

            if ($total == 0) {
                $dataResult['data'] = [];
                return $dataResult;
            }

            $query = $querySelectPart . ' ' . $queryFromPart . ' ' . $queryWherePart . ' ' . $queryLimitPart;
            $result = $this->connection->executeQuery($query);
            
            $dataResult['data'] = $result->fetchAll();
            return $dataResult;
        } catch (Exception $exception) {
            die('Error :' . $exception->getMessage());
        }
    }
}

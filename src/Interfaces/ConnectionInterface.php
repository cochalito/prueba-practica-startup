<?php

namespace App\PruebaPracticaStartup\Interfaces;

/**
 * Interface ConnectionInterface
 * @package App\PruebaPracticaStartup\Interfaces
 */
interface ConnectionInterface
{
    /**
     * Create a connection to the database.
     * @return bool True if the connection is successful, false otherwise.
     */
    public function createConnection(): bool;

    /**
     * Close the database connection.
     * @return void
     */
    public function closeConnection(): void;
    
    /**
     * Execute a query on the database.
     * @param string $query The SQL query to execute.
     * @return object The result of the executed query.
     */
    public function executeQuery($query): object;
}

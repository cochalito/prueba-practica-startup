<?php

namespace App\PruebaPracticaStartup\Models;

/**
 * Class Model
 *
 * This class serves as a base model for database interactions.
 * It provides methods to set and get the table name, as well as a method to get the current time.
 *
 * @package App\PruebaPracticaStartup\Classes
 */
abstract class Model
{
    /**
     * @var string $tableName The name of the table associated with the model.
     */
    protected $tableName;

    /**
     * Sets the table name for the model.
     *
     * @param string $tableName The name of the table.
     * @return void
     */
    protected function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }

    /**
     * Retrieves the table name associated with the model.
     *
     * @return string The table name.
     */
    protected function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * Retrieves the current time in 'Y-m-d H:i:s' format.
     *
     * @return string The current time.
     */
    protected function getCuurentTime(): string
    {
        return date('Y-m-d H:i:s');
    }
}

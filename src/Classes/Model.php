<?php

declare(strict_types=1);

namespace App\PruebaPracticaStartup\Classes;

abstract class Model
{
    protected $tableName;

    protected function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }

    protected function getTableName(): string
    {
        return $this->tableName;
    }
    protected function getCuurentTime(): string
    {
        return date('Y-m-d H:i:s');
    }
}

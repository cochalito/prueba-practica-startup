<?php

namespace App\PruebaPracticaStartup\Controllers;

use App\PruebaPracticaStartup\Classes\DBConnection;
use App\PruebaPracticaStartup\Views\Publisher;

class InstallController extends Controller
{
    private $connection;
    public function installTables(): void
    {
        $publisher = new Publisher();
        $this->connection = new DBConnection()->connection;
        if ($this->connection->installTables()) {
            $publisher->showView('success', [
                'title' => 'Instalacion de tabla exitosa',
                'message' => 'Se instalo y se insertaron los datos de tabla correctamente'
            ]);
        }
    }
}

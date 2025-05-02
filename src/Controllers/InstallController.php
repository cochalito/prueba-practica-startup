<?php

namespace App\PruebaPracticaStartup\Controllers;

use App\PruebaPracticaStartup\Classes\DBConnection;

/***
 * Class InstallController
 *
 * This class handles the installation of database tables and data.
 *
 * @package App\PruebaPracticaStartup\Controllers
 */
class InstallController extends Controller
{
    /**
     * @var DBConnection Instance of the DBConnection class for database connection.
     */
    private $connection;

    /***
     * InstallController constructor.
     *
     * Initializes the InstallController and creates an instance of the DBConnection class.
     */
    public function __construct()
    {
        parent::__construct();
        // Initialize the DBConnection instance and assign it to the connection property
        $this->connection = new DBConnection()->connection;
    }

    /**
     * Executes the installation of database tables and data.
     *
     * @return void
     */
    public function installTables(): void
    {
        if ($this->connection->installTables()) {
            $this->showMessage([
                'type' => 'success',
                'title' => 'Instalacion de tabla exitosa',
                'message' => 'Se instalo y se insertaron los datos de tabla correctamente'
            ]);
        }
    }
}

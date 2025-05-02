<?php

namespace App\PruebaPracticaStartup\Controllers;

use App\PruebaPracticaStartup\Controllers\InstallController;
use App\PruebaPracticaStartup\Controllers\ResourceController;

/**
 * Class CommandController
 *
 * This class handles the execution of commands from the command line interface.
 *
 * @package App\PruebaPracticaStartup\Controllers
 */
class CommandController extends Controller
{
    /**
     * @var array List of available actions for the command line interface.
     */
    private $actions = [
        'search' => 'search',
        'install' => 'install'
    ];

    public function __construct()
    {
        // Initialize the Publisher instance
        parent::__construct();
    }

    /**
     * Executes the specified action based on the provided parameters.
     *
     * @param array $params The parameters for the action.
     * @return void
     */
    public function executeAction(array $params): void
    {
        try {
            if (empty($params[1])) {
                $this->showMessage([
                    'type' => 'error',
                    'title' => 'Error al ejecutar comando.',
                    'message' => 'Debe ingrersar un comando de accion a ejecutar.',
                    'footer' => 'Ejemplo: php app.php [accion a ejecutar]'
                ]);
            }

            if (!in_array($params[1], $this->actions)) {
                $this->showMessage([
                    'type' => 'error',
                    'title' => 'Error al ejecutar comando.',
                    'message' => 'Debe ingrersar un comando de accion disponible.',
                    'footer' => 'Acciones disponibles: ' . implode(', ', $this->actions)
                ]);
            }
            
            $action = $params[1];
            $this->$action($params);
        } catch (\Exception $exception) {
            $this->showMessage([
                'type' => 'error',
                'title' => 'Error al validar comando.',
                'message' => $exception->getMessage()
            ]);
        }
    }
    
    /**
     * Installs the necessary tables in the database.
     *
     * @param array $params The parameters for the install action.
     * @return void
     */
    public function install(array $params): void
    {
        try {
            $installController = new InstallController();
            $installController->installTables();
        } catch (\Exception $exception) {
            $this->showMessage([
                'type' => 'error',
                'title' => 'Error al validar comando.',
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Searches for resources based on the provided filter.
     *
     * @param array $params The parameters for the search action.
     * @return void
     */
    public function search(array $params): void
    {
        try {
            if (empty($params[2])) {
                $this->showMessage([
                    'type' => 'error',
                    'title' => 'Error al ejecutar el comando.',
                    'message' => 'Por favor, asegúrese de proporcionar los argumentos requeridos.',
                    'footer' => 'Ejemplo: php app.php search [nombre a buscar]'
                ]);
            }

            if (strlen($params[2]) < 3) {
                $this->showMessage([
                    'type' => 'error',
                    'title' => 'Error al ejecutar el comando.',
                    'message' => 'Por favor, el filtro de busqueda debe tener al menos 3 caracteres.'
                ]);
            }

            $filter = $params[2];

            $resourceController = new ResourceController();
            $resourceController->search($filter);
        } catch (\Exception $exception) {
            $this->showMessage([
                'type' => 'error',
                'title' => 'Error al validar comando.',
                'message' => $exception->getMessage()
            ]);
        }
    }
}

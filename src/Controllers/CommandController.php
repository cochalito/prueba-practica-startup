<?php

namespace App\PruebaPracticaStartup\Controllers;

use App\PruebaPracticaStartup\Models\ResourcesModel;

class CommandController extends Controller
{
    private $actions = [
        'search' => 'search',
        'install' => 'install'
    ];

    public function validateCommand(array $params): void
    {
        try {
            $publisher = new Publisher();
            if (!empty($argv[1])) {
                $publisher->showView('error', [
                    'title' => 'Error al ejecutar comando.',
                    'message' => 'Debe ingrersar un comando de accion a ejecutar.',
                    'footer' => 'Ejemplo: php app.php [accion a ejecutar]';
                ]);
            }

            if (!in_array($argv[1], $this->actions)) {
                $publisher->showView('error', [
                    'title' => 'Error al ejecutar comando.',
                    'message' => 'Debe ingrersar un comando de accion disponible.',
                    'footer' => 'Acciones disponibles: ' . implode(', ', $this->actions)
                ]);
            }
            
            $action = $argv[1];
            $this->$action($argv);
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        $model = new ResourcesModel();
        $result = $model->executeAction($params);

        $drawer = new Drawer();
        print $drawer->drawResoursesResult($result);
    }

    
    public function search(array $params): void
    {
        try {
            $publisher = new Publisher();
            if (!empty($argv[2])) {
                $publisher->showView('error', [
                    'title' => 'Error al ejecutar el comando.',
                    'message' => 'Por favor, asegúrese de proporcionar los argumentos requeridos.',
                    'footer' => 'Ejemplo: php app.php search [nombre a buscar]';
                ]);
            }

            if (strlen($argv[2]) < 3) {
                $publisher->showView('error', [
                    'title' => 'Error al ejecutar el comando.',
                    'message' => 'Por favor, el filtro de busqueda debe tener al menos 3 caracteres.'
                ]);
            }

            $filter = $argv[2];

            $resourceController = new ResourceController();
            $resourceController->search($filter);
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        $model = new ResourcesModel();
        $result = $model->executeAction($params);

        $drawer = new Drawer();
        print $drawer->drawResoursesResult($result);
    }
}

<?php

require_once 'vendor/autoload.php';

use App\PruebaPracticaStartup\Controllers\ResourceController;

$resourceController = new ResourceController();
$resourceController->executeAction($argc);

var_dump($argc);
/*


$publisher = new Publisher();


if (empty($argv[1]) || empty($argv[2])) {
    $publisher->showView('success', [
        'title' => 'Error al ejecutar el comando.',
        'message' => 'Por favor, asegúrese de proporcionar los argumentos requeridos.',
        'footer' => 'Ejemplo: php app.php search [nombre a buscar]';
    ]);
    die();
}

if (strlen($argv[2]) < 3) {
    $publisher->showView('success', [
        'title' => 'Error al ejecutar el comando.',
        'message' => 'Por favor, el filtro de busqueda debe tener al menos 3 caracteres.'
    ]);
    die();
}

$action = $argv[1];
$value = $argv[2];


if ($action == 'search') {
    $filter = $value;

    $resourceController = new ResourceController();
    $resourceController->search($filter);
}
*/
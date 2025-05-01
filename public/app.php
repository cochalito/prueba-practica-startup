<?php

require_once 'vendor/autoload.php';

use App\PruebaPracticaStartup\Controllers\ResourceController;
use App\PruebaPracticaStartup\Classes\Drawer;

if (empty($argv[1]) || empty($argv[2])) {
    $drawer = new Drawer();
    $print = $drawer->drawErrorParams();
    echo $print;
    die();
}

if (strlen($argv[2]) < 3) {
    $drawer = new Drawer();
    $print = $drawer->drawErrorLenghtFilter();
    echo $print;
    die();
}

$action = $argv[1];
$value = $argv[2];


if ($action == 'search') {
    $filter = $value;

    $resourceController = new ResourceController();
    $resourceController->search($filter);
}

<?php

require_once 'vendor/autoload.php';

use App\PruebaPracticaStartup\Controllers\CommandController;

$commandController = new CommandController();
$commandController->executeAction($argv);

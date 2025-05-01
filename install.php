<?php

require_once 'vendor/autoload.php';

use App\PruebaPracticaStartup\Controllers\InstallController;

$installController = new InstallController();
$installController->installTables();

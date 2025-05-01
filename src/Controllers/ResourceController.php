<?php

namespace App\PruebaPracticaStartup\Controllers;

use App\PruebaPracticaStartup\Models\ResourcesModel;
use App\PruebaPracticaStartup\Classes\Drawer;

class ResourceController extends Controller
{

    public function search(string $filter): void
    {
        $model = new ResourcesModel();
        $result = $model->searchByName($filter);

        $drawer = new Drawer();
        print $drawer->drawResoursesResult($result);
        
    }    
}

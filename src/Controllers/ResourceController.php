<?php

namespace App\PruebaPracticaStartup\Controllers;

use App\PruebaPracticaStartup\Models\ResourcesModel;

/**
 * Class ResourceController
 * @package App\PruebaPracticaStartup\Controllers
 *
 * This class is responsible for handling resource-related actions.
 */
class ResourceController extends Controller
{
    /**
     * ResourceController constructor.
     */
    public function __construct()
    {
        // Initialize the Publisher instance
        parent::__construct();
    }

    /**
     * Searches for resources by name and displays the results.
     *
     * @param string $filter The filter string to search for resources.
     * @return void
     */
    public function search(string $filter): void
    {
        $model = new ResourcesModel();
        $result = $model->searchByName($filter);

        $this->publisher->showTableResources($result);
    }
}

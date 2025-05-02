<?php

namespace App\PruebaPracticaStartup\Controllers;

use App\PruebaPracticaStartup\Views\Publisher;
use Exception;

/**
 * Class Controller
 *
 * This is the base controller class that provides common functionality for all controllers.
 *
 * @package App\PruebaPracticaStartup\Controllers
 */
abstract class Controller
{
    /**
     * @var Publisher Instance of the Publisher class for displaying messages.
     */
    public $publisher;

    /**
     * Constructor for the Controller class.
     * Initializes the Publisher instance.
     */
    public function __construct()
    {
        $this->publisher = new Publisher();
    }

    /**
     * Show a message to the user.
     *
     * @param array $params Parameters for the message.
     * @return void
     */
    public function showMessage(array $params): void
    {
        try {
            $this->publisher->showMessage([
                'type' => $params['type'],
                'title' => $params['title'],
                'message' => $params['message'],
                'footer' => $params['footer'] ?? null
            ]);
        } catch (Exception $exception) {
            die('Existe un error al mostrar el mensaje: ' . $exception->getMessage());
        }
    }
}

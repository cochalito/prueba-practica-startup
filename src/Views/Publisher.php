<?php

namespace App\PruebaPracticaStartup\Views;

/**
 * Class Publisher
 * @package App\PruebaPracticaStartup\Views
 *
 * This class is responsible for displaying messages and tables to the user.
 */
class Publisher
{
    /**
     * Show a message to the user.
     *
     * @param array $params Parameters for the message.
     * @return void
     */
    public function showMessage(array $params): void
    {
        $messageBody = '';

        switch ($params['type']) {
            case 'success':
                $messageBody .= "\n\e[0;32m" . $params['title'] . "\e[0m\n";
                break;
            case 'error':
                $messageBody .= "\n\e[0;31m" . $params['title'] . "\e[0m\n";
                break;
            case 'info':
                $messageBody .= "\n\e[0;36m" . $params['title'] . "\e[0m\n";
                break;
            case 'warning':
            default:
                $messageBody .= "\n\e[0;33m" . $params['title'] . "\e[0m\n";
                break;
        }
        $messageBody .= "\033[1m" . $params['message'] . "\033[0m";

        if (!empty($params['footer'])) {
            $messageBody .= "\n{$params['footer']}";
        }

        $messageBody .= "\n\n";
        echo $messageBody;
        die();
    }

    /**
     * Show a table of resources to the user.
     *
     * @param array $result The result set containing resource data.
     * @return void
     */
    public function showTableResources(array $result): void
    {
        $total = $result['total'];
        if ($total == 0) {
            $this->showMessage([
                'type' => 'info',
                'title' => 'Sin registros encontrados.',
                'message' => 'No se encontraron coincidencias con el filtro ingresado.'
            ]);
        }

        $start = $result['start'];
        $limit = $result['limit'];
        $message = '';
        $message .= "\n\e[0;32mSe encontraron " . $total . " registros con el filtro ingresado.\e[0m\n";
        $message .= "\e[0;32mMostrando los registros del: " . $start . ' al ' . $limit . ".\e[0m\n\n";
        

        $message .= "|TIPO|\t\t|NOMBRE|\t\t\t\t|VALOR|"."\n";
        foreach ($result['data'] as $row) {
            $type = $row['type'] == '1' ? 'Clase' : 'Examen';

            $value = '[Sin Valor]';
            switch ($row['value']) {
                case '1':
                case '2':
                case '3':
                case '4':
                case '5':
                    $value = $row['value'] . '/5';
                    break;
                case '6':
                    $value = 'Selección';
                    break;
                case '7':
                    $value = 'Pregunta y Respuesta';
                    break;
                case '8':
                    $value = 'Completación';
                    break;
            }

            $message .= "$type\t\t{$row['name']}\t$value"."\n";
        }
        echo $message;
        die();
    }
}

<?php

declare(strict_types=1);

namespace App\PruebaPracticaStartup\Classes;

use PDOStatement;

class Drawer
{
    private function drawNotification(string $type, string $title, string $message, string $footer = ''): string
    {
        $print = '';
        switch ($type) {
            case 'success':
                $print .= "\n\e[0;32m" . $title . "\e[0m\n";
                break;
            case 'error':
                $print .= "\n\e[0;31m" . $title . "\e[0m\n";
                break;
            case 'info':
                $print .= "\n\e[0;36m" . $title . "\e[0m\n";
                break;
            case 'warning':
            default:
                $print .= "\n\e[0;33m" . $title . "\e[0m\n";
                break;
        }
        $print .= "\033[1m" . $message . "\033[0m\n\n";

        if (!empty($footer)) {
            $print .= "\n\n$footer\n\n";
        }
        return $print;
    }
    public function drawNoData(): string
    {
        $title = 'Sin registros.';
        $message = "No se encontraron coincidencias con el filtro ingresado.";
        return $this->drawNotification('info', $title, $message);
    }
    public function drawErrorParams(): string
    {
        $title = 'Error al ejecutar el comando.';
        $message = "Por favor, asegúrese de proporcionar los argumentos requeridos.";
        $footer = "Ejemplo: php app.php search [nombre a buscar]";
        return $this->drawNotification('error', $title, $message, $footer);
    }
    public function drawErrorLenghtFilter(): string
    {
        $title = 'Error al ejecutar el comando.';
        $message = "Por favor, el filtro de busqueda debe tener al menos 3 caracteres.";
        return $this->drawNotification('error', $title, $message);
    }

    public function drawResoursesResult(PDOStatement $result): string
    {
        $count = $result->rowCount();
        if ($count === 0) {
            return $this->drawNoData();
        }

        $print = '';
        $print .= "\n\e[0;32mSe encontraron " . $count . " registros con el filtro ingresado.\e[0m\n\n";
        

        $print .= "|ID|\t\t|TIPO|\t\t|NOMBRE|\t\t\t\t|VALOR|"."\n";
        while ($row = $result->fetch()) {
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

            $print .= "{$row['id']}\t\t$type\t\t{$row['name']}\t$value"."\n";
        }
        return $print; 
    }
}
<?php

namespace App\PruebaPracticaStartup\Classes;

use Exception;

/**
 * Class Environment
 *
 * This class is responsible for loading environment variables from a .env file.
 *
 * @package App\PruebaPracticaStartup\Classes
 */
class Environment
{
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected $path;

    /**
     * Environment constructor.
     *
     * @param string $path The path to the .env file.
     */
    public function __construct(string $path)
    {
        if (!file_exists(filename: $path)) {
            print 'El archivo .env no existe';
        }
        $this->path = $path;
    }

    /**
     * Load the environment variables from the .env file.
     *
     * @return void
     */
    public function load(): bool
    {
        try {
            if (!is_readable($this->path)) {
                print 'El archivo .env no puede leerse';
                return false;
            }
    
            $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
    
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);
    
                if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                    putenv(sprintf('%s=%s', $name, $value));
                    $_ENV[$name] = $value;
                    $_SERVER[$name] = $value;
                }
            }
            return true;
        } catch (Exception $exception) {
            print('Error al cargar el archivo .env: ' . $exception->getMessage());
            return false;
        }
    }
}

<?php

class EnvironmentTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        // Load the environment variables from the .env file
        (new \App\PruebaPracticaStartup\Classes\Environment(__DIR__ . '/../.env'))->load();
    }

    public function testLoadEnvironmentVariables()
    {
        // Check if the environment variables are loaded correctly
        $this->assertEquals('Startup Curso de Idiomas', getenv('APP_NAME'), 'Fallo en recuperar variables de entorno.');
    }
    public function testLoadEnvironmentWithInvalidPath()
    {
        // Check if the environment variables are loaded with other path
        // This should throw an exception or return false
        $response = (new \App\PruebaPracticaStartup\Classes\Environment(__DIR__ . '/../invalid_path/.env'))->load();
        $this->assertFalse($response, 'Fallo en depurar el path invalido');
    }
}

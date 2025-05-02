<?php

class CommandControllerTest extends \PHPUnit\Framework\TestCase
{
    protected $commandController;

    /**
     * @var \App\PruebaPracticaStartup\Controllers\CommandController
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->commandController = new \App\PruebaPracticaStartup\Controllers\CommandController();
    }

    public function testExecuteActionWithValidCommand()
    {
        $params = ['app.php', 'install'];
        $response = $this->commandController->executeAction($params);
        $this->assertTrue($response, 'Fallo en validar parametros');

        $messageBody = '';
        $messageBody .= "\n\e[0;32mInstalacion de tabla exitosa\e[0m\n";
        $messageBody .= "\033[1mSe instalo y se insertaron los datos de tabla correctamente\033[0m";
        $messageBody .= "\n\n";
        $this->expectOutputString($messageBody) ;
    }

    public function testExecuteActionWithInvalidCommand()
    {
        $params = ['app.php'];
        $response = $this->commandController->executeAction($params);
        $this->assertFalse($response, 'Fallo en invalidar parametros');

        $messageBody = '';
        $messageBody .= "\n\e[0;31mError al ejecutar comando.\e[0m\n";
        $messageBody .= "\033[1mDebe ingrersar un comando de accion a ejecutar.\033[0m";
        $messageBody .= "\nEjemplo: php app.php [accion a ejecutar]";
        $messageBody .= "\n\n";

        $this->expectOutputString($messageBody) ;
    }

    
    public function testExecuteActionWithInvalidAction()
    {
        $params = ['app.php', 'test'];
        $response = $this->commandController->executeAction($params);
        $this->assertFalse($response, 'Fallo en invalidar parametros');

        $messageBody = '';
        $messageBody .= "\n\e[0;31mError al ejecutar comando.\e[0m\n";
        $messageBody .= "\033[1mDebe ingrersar un comando de accion disponible.\033[0m";
        $messageBody .= "\nAcciones disponibles: " . implode(', ', $this->commandController->actions);
        $messageBody .= "\n\n";

        $this->expectOutputString($messageBody) ;
    }

    
    public function testExecuteActionSearchWithfilter2chars()
    {
        $params = ['app.php', 'search', 'te'];
        $response = $this->commandController->search($params);
        $this->assertFalse($response, 'Fallo en invalidar parametros');

        $messageBody = '';
        $messageBody .= "\n\e[0;31mError al ejecutar el comando.\e[0m\n";
        $messageBody .= "\033[1mPor favor, el filtro de busqueda debe tener al menos 3 caracteres.\033[0m";
        $messageBody .= "\n\n";

        $this->expectOutputString($messageBody) ;
    }
}

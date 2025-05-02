<?php

use App\PruebaPracticaStartup\Classes\DBConnectionMysql;

class DBConnectionTest extends \PHPUnit\Framework\TestCase
{
    protected $dbConnection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dbConnection = new DBConnectionMysql(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            $_ENV['DB_NAME']
        );
    }

    public function testCreateConnection()
    {
        $this->assertTrue($this->dbConnection->createConnection(), 'Fallo prueba de creaccion de conexion a DB.');
    }
    public function testCloseConnection()
    {
        $this->dbConnection->createConnection(); // Ensure the connection is created first
        $this->dbConnection->closeConnection();
        $this->assertFalse($this->dbConnection->verifyConnection(), 'Fallo prueba de cerrar conexion a DB.');
    }
}

<?php

use Mockery as m;
use Nobodyiscertain\DbCommands\Console\Commands\DbTestPrepare;

class DbTestPrepareTest extends PHPUnit_Framework_TestCase
{

    protected $configMock;

    protected $commandMock;

    public function setUp()
    {
        parent::setUp();

        $this->buildMocks();
    }

    public function tearDown()
    {
        parent::tearDown();

        m::close();
    }

    /** @test **/
    public function it_is_initializable()
    {
        $this->assertInstanceOf('Nobodyiscertain\DbCommands\Console\Commands\DbTestPrepare', new DbTestPrepare);
    }

    /** @test **/
    public function it_calls_migrate_command_and_seeds()
    {
        $this->commandMock
            ->shouldReceive('info')
            ->with('Running migrations on testing database.')
            ->once()
            ->andReturnNull();

        $this->commandMock
            ->shouldReceive('call')
            ->once()
            ->with('migrate:refresh', ['--database' => 'testing'])
            ->andReturnNull();

        $this->commandMock
            ->shouldReceive('info')
            ->once()
            ->with('Running seed scripts on testing database.')
            ->andReturnNull();

        $this->commandMock
            ->shouldReceive('call')
            ->once()
            ->with('db:seed', ['--database' => 'testing'])
            ->andReturnNull();

        $this->commandMock
            ->shouldReceive('info')
            ->once()
            ->with('Happy Testing!')
            ->andReturnNull();

        $this->commandMock->handle($this->configMock);
    }

    private function buildMocks()
    {
        $this->configMock = m::mock('Illuminate\Config\Repository');

        $this->configMock
            ->shouldReceive('get')
            ->with('laravel-db-commands.testing_db_connection')
            ->andReturn('testing');

        $this->commandMock = m::mock('Nobodyiscertain\DbCommands\Console\Commands\DbTestPrepare')->makePartial();
    }
}

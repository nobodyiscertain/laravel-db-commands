<?php

use Mockery as m;
use Nobodyiscertain\DbCommands\Console\Commands\DbBackup;

class DbBackupTest extends PHPUnit_Framework_TestCase
{
    protected $configMock;

    protected $commandMock;

    protected $storageMock;

    protected $filesystemMock;

    public function setUp()
    {
        parent::setUp();

        $this->filesystemMock = m::mock('Illuminate\Filesystem\Filesystem');

        $this->commandMock = m::mock('Nobodyiscertain\DbCommands\Console\Commands\DbBackup')->makePartial()->shouldAllowMockingProtectedMethods();

        $this->storageMock = m::mock('Illuminate\Filesystem\FilesystemManager');

        $this->configMock = m::mock('Illuminate\Config\Repository');

        $this->configMock
            ->shouldReceive('get')
            ->with('laravel-db-commands.backup_db_conn')
            ->andReturn('production');

        $this->configMock
            ->shouldReceive('get')
            ->with('database.connections.production')
            ->andReturn([
                'host' => 'localhost',
                'database' => 'production',
                'username' => 'forge',
                'password' => 'forge',
            ]);

        $this->configMock
            ->shouldReceive('get')
            ->with('laravel-db-commands.backup_dump_destination')
            ->andReturn('/tmp');

        $this->configMock
            ->shouldReceive('get')
            ->with('laravel-db-commands.backup_disk')
            ->andReturn('s3');
    }

    public function tearDown()
    {
        parent::tearDown();

        m::close();
    }

    /** @test **/
    public function it_is_initializable()
    {
        $this->assertInstanceOf('Nobodyiscertain\DbCommands\Console\Commands\DbBackup', new DbBackup);
    }

    /** @test **/
    public function it_gets_dump_of_db_and_stores_to_disk()
    {
        $this->storageMock
            ->shouldReceive('disk')
            ->with('s3')
            ->andReturn($this->filesystemMock);

        $this->commandMock
            ->shouldReceive('dumpMysqlDatabase')
            ->once();

        $this->commandMock
            ->shouldReceive('uploadDumpToDisk')
            ->once();

        $this->commandMock->handle($this->configMock, $this->storageMock);
    }

}

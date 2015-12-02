<?php

use Nobodyiscertain\DbCommands\Console\Commands\DbBackup;

class DbBackupTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_is_initializable()
    {
        $this->assertInstanceOf('Nobodyiscertain\DbCommands\Console\Commands\DbBackup', new DbBackup);
    }
}

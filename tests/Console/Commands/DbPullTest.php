<?php

use Nobodyiscertain\DbCommands\Console\Commands\DbPull;

class DbPullTest extends PHPUnit_Framework_TestCase
{
    /** @test **/
    public function it_is_initializable()
    {
        $this->assertInstanceOf('Nobodyiscertain\DbCommands\Console\Commands\DbPull', new DbPull);
    }
}

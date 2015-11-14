<?php

class DbTestPrepareTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->command = new \Nobodyiscertain\DbCommands\Console\Commands\DbTestPrepare;
    }

    /** @test **/
    public function it_is_initializable()
    {
        $this->assertInstanceOf('Nobodyiscertain\DbCommands\Console\Commands\DbTestPrepare', $this->command);
    }

}

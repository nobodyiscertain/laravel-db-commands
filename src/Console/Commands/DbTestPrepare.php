<?php

namespace Nobodyiscertain\DbCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Config\Repository as Config;

class DbTestPrepare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:test-prepare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset database and seeds.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Config $config)
    {
        $db_conn = $config->get('laravel-db-commands.testing_db_connection');

        $this->info("Running migrations on $db_conn database.");
        $this->call('migrate:refresh', ['--database' => $db_conn]);

        $this->info("Running seed scripts on $db_conn database.");
        $this->call('db:seed', ['--database' => $db_conn]);

        $this->info('Happy Testing!');
    }
}

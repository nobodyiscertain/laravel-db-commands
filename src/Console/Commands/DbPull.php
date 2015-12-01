<?php

namespace Nobodyiscertain\DbCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Config\Repository as Config;

class DbPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:pull {env}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull the database from other environments.';

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
        $env = $this->argument('env');
        $local_db_conn = $config->get('laravel-db-commands.dbpull_local_db_conn');
        $dump_dest = $config->get('laravel-db-commands.dbpull_dump_destination');

        $env_db = $config->get("database.connections.$env");
        $local_db = $config->get("database.connections.$local_db_conn");

        $db_name = $env_db['database'];

        $backup_name = $db_name . '-' . time() . '.sql.gz';
        $tmp_file = "$dump_dest/$backup_name";

        $this->info("Downloading database from $env");
        $output = $this->dumpRemoteMysqlDb($env_db, $tmp_file);
        $this->info($output);

        $this->info("Importing database locally");
        $output = $this->importMysqlDump($local_db, $tmp_file);
        $this->info($output);

        $this->info('All done!');
    }

    /**
     * Run mysqldump command on command line
     *
     * @param array $env_db Array of database config
     * @param string $filename The filename to write the dump too.
     *
     * @return string Output from command line.
     */
    public function dumpRemoteMysqlDb($env_db, $filename)
    {
        return shell_exec('mysqldump -h ' . $env_db['host'] . ' -u ' . $env_db['username'] . ' -p' . $env_db['password'] . ' ' . $env_db['database'] . ' | gzip > ' . $filename);
    }


    /**
     * Import mysql database dump locally
     *
     * @param array Databae connection config array
     * @param string The filename of the db dump.
     *
     * @return string Output from command line.
     */
    public function importMysqlDump($db_conn, $filename)
    {
        return shell_exec('gunzip < ' . $filename . ' | mysql -u '. $db_conn['username'] . ' -p' . $db_conn['password']  . ' ' . $db_conn['database']);
    }
}

<?php

namespace Nobodyiscertain\DbCommands\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
//use Storage;

class DbPullCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'db:pull {env=production}';

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
    public function fire()
    {
        $env = strtoupper($this->argument('env'));
        $this->info("Downloading database from $env");

        //$db_host = env("{$env}_DB_HOST");
        //$db_name = env("{$env}_DB_DATABASE");
        //$db_user = env("{$env}_DB_USERNAME");
        //$db_pass = env("{$env}_DB_PASSWORD");

        //$local_db_host = env("DB_HOST");
        //$local_db_name = env("DB_DATABASE");
        //$local_db_user = env("DB_USERNAME");
        //$local_db_pass = env("DB_PASSWORD");

        //$backup_name = time() . '-' . $db_name . '.sql.gz';
        //$tmp_file = "/tmp/$backup_name";

        //$this->info("Downloading database from $env");
        //$output = shell_exec("mysqldump -h $db_host -u $db_user -p$db_pass $db_name | gzip > $tmp_file");
        //$this->info($output);

        //$this->info("Importing database locally");
        //$output = shell_exec("gunzip < $tmp_file | mysql -u $local_db_user -p$local_db_pass $local_db_name");
        //$this->info($output);
    }

}

<?php

namespace Nobodyiscertain\DbCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Config\Repository as Config;
use Illuminate\Filesystem\FilesystemManager as Storage;

class DbBackup extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database.';

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
    public function handle(Config $config, Storage $storage)
    {
        $conn = $config->get('laravel-db-commands.backup_db_conn');
        $db = $config->get("database.connections.$conn");
        $dump_dest = $config->get('laravel-db-commands.backup_dump_destination');
        $backup_disk_name = $config->get('laravel-db-commands.backup_disk');
        $backup_disk = $storage->disk($backup_disk_name);
        $backup_name = $db['database'] . '-' . time() . '.sql.gz';
        $tmp_file = "$dump_dest/$backup_name";

        $this->dumpMysqlDatabase($db, $tmp_file);

        $this->uploadDumpToDisk($backup_disk, $backup_name, $tmp_file);
    }

    protected function dumpMysqlDatabase($db, $tmp_file)
    {
        $db_host = $db['host'];
        $db_name = $db['database'];
        $db_user = $db['username'];
        $db_pass = $db['password'];

        $this->info("Generating Backup File");

        $output = shell_exec("mysqldump -h $db_host -u $db_user -p$db_pass $db_name | gzip > $tmp_file");

        $this->info($output);
    }

    protected function uploadDumpToDisk($disk, $name, $file)
    {
        $this->info("Uploading database to disk");

        $disk->put($name, file_get_contents($file));
    }
}

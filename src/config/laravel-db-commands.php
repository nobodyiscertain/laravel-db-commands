<?php

return [

    /*
     * Testing database connection name used in config/database.php
     */
    'testing_db_connection' => 'testing',

    /*
     * Would you like seeds to be run after refreshing the database?
     */
    'testing_run_seeds' => true,

    /*
     * When pulling the database, should I automatically import it?
     */
    'dbpull_auto_import' => true,

    /*
     * Local database connection name used in config/database.php
     */
    'dbpull_local_db_conn' => 'mysql',

    /*
     * The file directory to put the database dump.
     */
    'dbpull_dump_destination' => '/tmp',

    /*
     * The name of the database connection to backup.
     */
    'backup_db_conn' => 'mysql',

    /*
     * The destination to temporarily store the backup locally.
     */
    'backup_dump_destination' => '/tmp',

    /*
     * The disk name to save the backup to.
     */
    'backup_disk' => 's3',
];

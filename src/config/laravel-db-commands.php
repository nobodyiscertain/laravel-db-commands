<?php

return [
    'testing_db_connection' => 'testing',
    'testing_run_seeds' => true,

    'dbpull_auto_import' => true,
    'dbpull_local_db_conn' => 'mysql',
    'dbpull_dump_destination' => '/tmp',

    'backup_db_conn' => 'mysql',
    'backup_dump_destination' => '/tmp',
    'backup_disk' => 's3',
];

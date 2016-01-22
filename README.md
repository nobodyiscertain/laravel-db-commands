# Laravel DB Commands

Here are few Artisan commands to help with common database tasks. This
package currently handles:

* [Pulling the Database](#pulling-the-database)
* [Preparing the Test Database](#preparing-the-test-database)
* [Backing up the Database](#backing-up-the-database)

*Note: Currently, this package only supports MySQL. Should you have a
need for a different database driver, please open an issue or feel
free to fork and pull request away.*

## Installation

Install with Composer:
```
composer require nobodyiscertain/laravel-db-commands
```

Add service provider to config/app.php:
```
Nobodyiscertain\DbCommands\DbCommandsServiceProvider::class
```

On the command line, run:
```
php artisan vendor:publish
```
This will publish the config file `laravel-db-commands.php` to your
config directory. You will need to configure that to match your setup
and you should be good to go! Details on the configuration for each of
the commands can be found below.

## Pulling the Database
This command makes it a snap to pull a database dump from a specific
environment. After you have it configured, a simple `php artisan db:pull
production` will pull the production database and import it locally.

#### How to Run
```
php artisan db:pull <db_connection_name>
```

`db_connection_name`: Pass in the name of the connection used in your
`config/database.php` that you'd like to pull.

#### Configuration
`dbpull_auto_import`: If you would like the database to be auto imported
locally after it's pulled, set this to true, otherwise, false.

`dbpull_local_db_conn`: Set this to the name of your local db connection
you'd like the dump imported to.

`dbpull_dump_destination`: Set this to a local path you'd like the dump
to be stored. I generally use `/tmp` so it'll get wiped.

## Preparing the Test Database
This command saves the hassle of typing the lengthy artisan command to
refresh the testing database and, optionally, run the seeds. Inspried
by a similar command in Rails.

#### How to Run
```
php artisan db:test-prepare
```

#### Configuration
`testing_db_connection`: Set this to the name of the testing database
connection configured in `config/database.php`.

`testing_run_seeds`: If you'd like to run the seeds after the database
is refreshed, set this to true, otherwise, false.

## Backing up the Database
This command will pull a database dump and upload it to a configured
filesystem location. It's great for making one off backups or scheduling
with Artisan to make automated backups a breeze.

#### How to Run
```
php artisan db:backup
```

#### Configuration
`backup_db_conn`: This is the name of database connection in
`config/database.php` you'd like to backup. Keep in mind the context of
where this command will run. If it's going to be run on the a prodcution
server, then most likely it'll be your default `mysql` connection.

`backup_dump_destination`: A local filepath to store the database dump.
If on a UNIX-based system, `/tmp` works great.

`backup_disk`: This is the disk name from `config/filesystems.php` that
you'd like to permanently store the database dump.

If you'd like to setup automated backups, drop in something like this
into `app/Console/Kernal.php`.

```php
$schedule->command('db:backup')->twiceDaily();
```









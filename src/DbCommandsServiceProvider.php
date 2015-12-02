<?php

namespace Nobodyiscertain\DbCommands;

use Illuminate\Support\ServiceProvider;

class DbCommandsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config' => config_path('laravel-db-commands'),
        ]);
    }

    public function register()
    {
        // DB Pull
        $this->app->singleton('command.db.pull', function ($app) {
            return $app['Nobodyiscertain\DbCommands\Console\Commands\DbPull'];
        });
        $this->commands('command.db.pull');

        // DB Test Prepare
        $this->app->singleton('command.db.test-prepare', function ($app) {
            return $app['Nobodyiscertain\DbCommands\Console\Commands\DbTestPrepare'];
        });
        $this->commands('command.db.test-prepare');

        $this->mergeConfigFrom(
            __DIR__ . '/config/laravel-db-commands.php', 'laravel-db-commands'
        );
    }
}

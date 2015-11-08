<?php

namespace Nobodyiscertain\DbCommands;

use Illuminate\Support\ServiceProvider;

class DbCommandsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('command.db.pull', function ($app) {
            return $app['Nobodyiscertain\DbCommands\Console\Commands\DbPullCommand'];
        });
        $this->commands('command.db.pull');
    }
}

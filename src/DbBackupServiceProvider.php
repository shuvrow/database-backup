<?php

namespace Rashed\Backup;

use Illuminate\Support\ServiceProvider;

class DbBackupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Rashed\Backup\DbBackupController');
    }

}

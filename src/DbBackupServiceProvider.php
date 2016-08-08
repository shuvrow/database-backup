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
        $this->loadViewsFrom(__DIR__.'/views', 'backup');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/hoque/backup'),
        ]);
        $this->publishes([
            __DIR__.'/Events' => base_path('app/Events'),
        ]);
        $this->publishes([
            __DIR__.'/Listeners' => base_path('app/Listeners'),
        ]);
        $this->publishes([
            __DIR__.'/Commands' => base_path('app/Console/Commands'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Rashed\Backup\DbBackupController');


    }

}

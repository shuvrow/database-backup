
# DB-Backup
Database Auto Backup For Laravel 5.2 users
##Installation

Db-backup is a laravel package. You can install it via composer.In your project directory run following command: 


```composer require 'rashed/db-backup':'dev-master'```

##Configuration<i class="icon-cog"></i>


Set directory for database backup on web server.Add **DB_BACKUP** on  **.env** file as follow

####DB_BACKUP=directory_name

When download is completed, add following line on **app.php** file in **providers** section

    \Rashed\Backup\DbBackupServiceProvider::class

###publish<i class="icon-upload">


Now run following command from terminal

   

    php artisan config:clear 
    php artisan vendor:publish

This will publish all necessary file for this package.


Now on  **app/Providers/EventServiceProvider.php** file add following lines in **$listen**  variable.

    'Rashed\Backup\Events\DbBackupEvent' => [
            'Rashed\Backup\Listeners\DbBackupEventListener',
        ],




Usages
-------------

    Event::fire(new \Rashed\Backup\Events\DbBackupEvent());

> **Note:**

> - Use this event to export database<i class="icon-hdd"></i> in your local disk.
> - This event store database on user's machine and remove it from server.
> - If you want to store database on server periodically Make sure your configure it first.[<i class="icon-refresh"></i> Schedule Backup](#schedule-backup) .


####schedule-backup

This option required configuration for db auto backup on server using task scheduling.
To use this option you have to add a cron entry on your server.

    * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
	
After adding this, add following line in **$commands** variable on **app/Console/kernel.php** file:

    Commands\Backup::class,

And on `schedule()` function add scheduler as your requirements.

For example if you want to backup your database after every 30 minutes 
write following code

    $schedule->command('Backup')->everyThirtyMinutes();

backup your database after every 10 minutes , write following code :

    $schedule->command('Backup')->everyTenMinutes();

 




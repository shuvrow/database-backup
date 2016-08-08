<?php

namespace Rashed\Backup\Listeners;

use Rashed\Backup\Events\DbBackupEvent;


class DbBackupEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(DbBackupEvent $event)
    {
        $event->backup();

    }
}

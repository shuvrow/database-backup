<?php

namespace Rashed\Backup\Events;

use App\Events\Event;
use Rashed\Backup\DbBackupController;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Response;

class DbBackupEvent extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $backupController;
    public function __construct()
    {

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
    public function backup()
    {
        $backup=new DbBackupController();
        return Response::download($backup->index(),'Bappu-bac');

    }
}

<?php

namespace Rashed\Backup;


use App\Http\Controllers\Controller;
use Carbon\Carbon as Carbon;
class DbBackupController extends Controller{
    protected $status=false;
    public function index()
    {
        $dbuser = env('DB_USERNAME');
        $dbpass = env('DB_PASSWORD');
        $dbname = env('DB_DATABASE');
        $directory=env('DB_BACKUP');

        $carbon=new Carbon();
        $dbNewName='db-backup-'.$carbon->now()->format('Y-m-d-h-i-s');
        $fileFullPath=$directory.'/'.$dbNewName.'.sql';
        $mySqlDump=exec('which mysqldump');

        if(!is_dir($directory))
        {
            mkdir($directory,0755,true);

        }
        $command = "$mySqlDump --opt -u $dbuser -p$dbpass $dbname > $fileFullPath";

        exec($command);
        try
        {
            $this->status=true;

            $this->download($fileFullPath);

        }
        catch(\Exception $e)
        {
            $this->status=false;
        }

    }
    public function download($fileFullPath)
    {
        $downloadableFilePath= $fileFullPath;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=\"" . basename($downloadableFilePath) . "\";");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($downloadableFilePath));
        flush();
        readfile($downloadableFilePath);
        unlink($downloadableFilePath);
        exit;
    }


}
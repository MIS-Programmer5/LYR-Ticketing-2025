<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NotifReceiver extends Model
{
    use HasFactory;
    public $nrid;
    public $notifid;
    public $userid;
    public $readat;
    public $created;
    public $updated;
    public $results;
    public $tcode;
    public $type;
    public $lastInsertedId;

    public function AddReceiver()
    {
        try {
            DB::select('CALL AddNotifReceiver(?, ?, ?, ?) ', [$this->notifid, $this->userid, $this->created, $this->updated]);
            $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            $this->results = "receiver Added";
        } catch (\Exception $e) {
            $this->results = $e->getMessage();
        }

    }
    public function UpdateReadAt()
    {
        try {
            DB::update('CALL UpdateReadAt(?, ?, ?, ?)', [$this->nrid, $this->readat, $this->tcode, $this->userid ]);
            $this->results = "updated";
        } catch (\Exception $e) {
            $this->results = $e->getMessage();

        }
          return null;


    }
       public function MarkAllasRead()
    {
        try {
            DB::select('CALL MarkAllasRead(?, ?, ?)', [$this->userid, $this->readat, $this->type]);
            $this->results = "updated";
        } catch (\Exception $e) {
            $this->results = $e->getMessage();
        }
    }
       public function MarkasRead()
    {
        try {
            DB::select('CALL MarkAsRead(?, ?)', [$this->nrid, $this->readat]);
            $this->results = "updated";
        } catch (\Exception $e) {
            $this->results = $e->getMessage();
        }
    }
}

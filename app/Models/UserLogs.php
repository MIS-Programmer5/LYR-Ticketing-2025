<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Result;

class UserLogs extends Model
{
    use HasFactory;
    public $ticketid;
    public $userid;
    public $statusid;
    public $remarks;
    public $token;
    public $result;
    public $error;
    public $request;
    public $added;





    public function AddUserLogs()
    {
        try {
            DB::select('CALL AddUserlogs(?,?,?,?,?,?)', [$this->token, $this->userid, $this->ticketid, $this->statusid, $this->remarks, $this->added]);
            $this->result = "userlogs added";
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }
    }
    public function GetUserLogs()
    {
        try {
            return $this->result = DB::select('CALL getUserLogs(?)', [$this->ticket_id]);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }
    }
    public function UpdateUserlogs()
    {
        try {
            return $this->result = DB::select('CALL getUserLogs(?)', [$this->ticket_id]);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }
    }
}

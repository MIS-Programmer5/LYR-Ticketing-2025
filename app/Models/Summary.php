<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Summary extends Model
{
    use HasFactory;

    public $department_id;
    public $user_id;


    function CountTicketbyDepartment()
    {
        try {
            $this->result = DB::select('CALL `CountTicketsperDepartment`(?,?)', [$this->department_id, $this->user_id]);
            return json_encode($this->result);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }


    }
    function CountTicketbyMonth()
    {
        try {
            $this->result = DB::select('CALL `CountTicketsperMonth`(?,?)', [$this->department_id, $this->user_id]);
            return json_encode($this->result);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }


    }

    function CountTicketbyIssue()
    {
        try {
            $this->result = DB::select('CALL `CountTiccketsperIssue`(?,?)', [$this->department_id, $this->user_id]);
            return json_encode($this->result);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }


    }

    function AllLogsbyUser()
    {
        try {
            $this->result = DB::select('CALL `GetAllUserLogs`(?,?)', [$this->user_id, $this->department_id]);
            return json_encode($this->result);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }


    }
    function GetAverageResolutionTime()
    {
        try {
            $this->result = DB::select('CALL `GetAverageResolutionTime`(?,?)', [$this->user_id, $this->department_id]);
            return json_encode($this->result);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }


    }
    function GetTicketsperDay()
    {
        try {
            $this->result = DB::select('CALL `getTicketsperday`(?,?)', [$this->department_id, $this->user_id]);
            return json_encode($this->result);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }


    }
    function GetTaskvsClosed()
    {
        try {
            $this->result = DB::select('CALL `GetTaskvsClosed`(?)', [$this->department_id]);
            return json_encode($this->result);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }


    }

}

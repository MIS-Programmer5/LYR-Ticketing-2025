<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLogs as logs;
use App\Models\Approvals as Approvals;
use App\Models\Status as Status;

class UserLogsController extends Controller
{
    public $logs;
    public $approve;
    public $status;

    public function __construct()
    {
        $this->logs = new logs;
        $this->approve= new Approvals;
        $this->status = new Status;
    }
    public function getUserlogs($tid){
        try {
            $this->logs->ticket_id=$tid;
            return $this->logs->GetUserLogs();

        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
    public function ApprovalPage()
    {
        if(session()->has("user")) {
            return view('Ticket/Approvals')->with('status', $this->status);
        }

        return redirect("/");

    }
    public function GetApproval($did)
    {
        $test=0;
        try {
          $this->approve->department_id = intval($did);
          return $this->approve->getApprovals();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
    public function TaskApproved()
    {
        try {

            return $this->approve->getApprovals();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
}

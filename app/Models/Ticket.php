<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Ticket extends Model
{
    use HasFactory;

    public $request;
    public $icon;
    public $result;
    public $error;
    public $department_id;
    public $user_id;
    public $status_id;
    public $ticketid;
    public $classid;
    public $issueid;
    public $prioid;
    public $ticket_code;
    public $assignee;
    public $tname;
    public $tposition;
    public $temail;
    public $trequester;
    public $treceiver;
    public $tsubject;
    public $tdescription;
    public $tdeudate;
    public $created;
    public $updated;
    public $workingtime;
    public $type;
    public $keyword;





    public function AddTicket()
    {
        $self=new Self();

        try{

        //start
            $department_id = $this->request->input('branch_department');
            $requester_department_id = $this->request->input('addressto');
            $name = $this->request->input('name');
            $email = $this->request->input('company_email');
            $position = $this->request->input('position');
            $ticket_subject = str_replace(["`"], "'", $this->request->input('subject'));
            $ticket_description = str_replace(["`"], "'", $this->request->input('description'));
        //ticket code
            $results = DB::select('CALL AddTicket(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$position, $email, $name, $department_id, $requester_department_id, $ticket_subject, $ticket_description, session()->get("user")->id, $this->ticket_code, $this->created, $this->updated]);
            $this->result = "Add Ticket Succeed";
            $this->icon = "success";
            return $this->result;

        } catch (\Exception $e) {
            $this->result = $e->getMessage();
            $this->icon = "error";

            return $this->result;
        }
    }
    public function addfile($filename,$code){
        DB::select('CALL AddFile(?,?)', [ $filename, $code]);
    }

    public function getTickets()
    {
        // $this->result = self::all();
        $this->results = DB::select('CALL GetTickets(?,?,?)', [$this->department_id, $this->user_id, $this->assignee]);

        return response()->json($this->results);
    }
    public function getAllTickets()
    {
        $this->results = DB::select('CALL GetAllTickets(?,?,?)', [$this->department_id, $this->user_id, $this->assignee]);
        return response()->json($this->results);
    }
     public function getTicketDetails()
    {
        try{
        // $this->result = self::all();
            $this->results = DB::select('CALL GetDetails(?)', [$this->ticket_code]);
            return response()->json($this->results);

        }catch(\Exception $e){
            $this->results=$e->getMessage();
        }
    }
    public function SetInstruction()
    {
        // $this->result = self::all();
        try {
            $this->results = DB::select('CALL ticketInstruction(?,?,?,?,?,?)', [$this->request->input("priority"), $this->request->input("class"), $this->request->input("status"), $this->request->input("issue"), $this->request->input("employee"), $this->request->input("id")]);
            $this->result = "Instruction Successful";
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }
    public function getTasks()
    {
        try {
            $this->results = DB::select('CALL GetTask(?,?)', [$this->user_id,$this->department_id]);
            return response()->json($this->results);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }
    public function TransferTask()
    {
        try {
            $uid=$this->request->input('uid');
            $tid=$this->request->input('ticket_id');
            DB::select('CALL Transmital(?,?)', [$uid,$tid]);
            $this->result="Update Success";
        } catch (\Exception $e) {

            $this->result= $e->getMessage();

        }
    }
    public function UpdateState()
    {
        try {
            // $uid=$this->request->input('status');
            // $tid=$this->request->input('id');
            DB::select('CALL UpdateTicket(?,?)', [$this->status_id, $this->ticketid]);
            $this->result="Status Update ";
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }
    }
    public function EditTicket()
    {
        try {
            DB::select('CALL EditTicket(?,?,?,?,?,?,?,?,?)', [$this->tname, $this->tposition, $this->trequester, $this->treceiver, $this->ticketid, $this->tsubject, $this->tdescription, $this->temail,$this->user_id]);
             $this->result="Status Update ";
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }
    }
    public function getClosedTicket()
    {
        try {
             $this->result=DB::select('CALL GetClosedTickets(?,?)', [ $this->department_id,$this->user_id]);
             return json_encode($this->result);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }
    }
    public function updateDueDate()
    {
        try {
             DB::select('CALL UpdateDueDate(?,?)', [ $this->ticketid,$this->tdeudate]);
             return $this->result= $this->result."success";
        } catch (\Exception $e) {
            return $this->result = $this->result.$e->getMessage();
        }
    }
     public function UpdatePrioClassIssue()
    {
        try {
             DB::select('CALL UpdatePrioClassIssue(?,?,?,?)', [ $this->classid,$this->issueid,$this->prioid,$this->ticketid]);
             return $this->result= $this->result."success";
        } catch (\Exception $e) {
            return $this->result = $this->result.$e->getMessage();
        }
    }
    public function getCanceledandDisapprovedTicket()
    {
        try {
            $this->result = DB::select('CALL getCanceledandDisapproved(?,?)', [$this->department_id, $this->user_id]);
            return json_encode($this->result);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }
    }

    public function UpdateWorkingTime()
    {
        try {
            $this->result = DB::select('CALL UpdateWorkingTime(?,?)', [$this->ticketid, $this->workingtime]);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }
    }
    public function TicketCount()
    {
        try {

            return DB::select('CALL TicketCounter(?)', [$this->created]);
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }
    }
     public function SearchTicket()
    {
        try {
            $this->result = DB::select('CALL `SearchTicket`(?)', [$this->keyword]);

            return $this->result;
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }
    }

    public function GetQueueingByClassification()
    {
        try {
            $this->result = DB::select('CALL `QueueingByClassification`(?)', [$this->user_id]);

            return $this->result;
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }
    }


}

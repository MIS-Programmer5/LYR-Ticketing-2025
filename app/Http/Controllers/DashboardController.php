<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Department as Department;
use App\Models\Ticket as Ticket;
use App\Models\Status as Status;
use App\Models\Priority as Priority;
use App\Models\Issue as Issue;
use App\Models\Classification as Classification;
use App\Models\User as User;
use App\Models\UserLogs as UserLogs;
use App\Models\FileUpload as File;
use App\Models\Email as Emails;
use App\Models\Dashboard as Dashboard;

// use App\Mail\Email as Email;

use App\Notifications\Ticket as Notifticket;
use App\Notifications\OffersNotification as OffersNotification;

class DashboardController extends Controller
{
    public $department;
    public $ticket;
    public $priority;
    public $status;
    public $user;
    public $issue;
    public $class;
    public $userlog;
    public $file;
    public $email;
    public $dashboard;

    public function __construct()
    {
        $this->department = new Department;
        $this->ticket = new Ticket;
        $this->priority = new Priority;
        $this->status = new Status;
        $this->user = new User;
        $this->issue = new Issue;
        $this->class = new Classification;
        $this->userlog = new UserLogs;
        $this->file = new File;
        $this->email = new Emails;
        $this->dashboard=new Dashboard;
    }
    public function Dashboardpage()
    {
        try{
            if (session()->has("user")){
                    $this->ticket->department_id = session()->get("user")->Department_id;
                    $this->class->depid =  session()->get("user")->Department_id;
                    return view('Dashboard/Dashboard')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class);
            }else{
                 return redirect("/");
            }
        }catch(\Exception $e){
            return dd($e->getMessage());
        }
    }
       public function GetQueueingByClassification($uid){
        try{

            $this->ticket->user_id = $uid;
            $this->ticket->GetQueueingByClassification();


            return $this->ticket->result;

        }catch(\Exception $e){
            return dd($e->getMessage());
        }
    }
}

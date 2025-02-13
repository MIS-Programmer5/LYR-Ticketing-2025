<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Department as Department;
use App\Models\Ticket as Ticket;
use App\Models\Status as Status;
use App\Models\Priority as Priority;
use App\Models\Issue as Issue;
use App\Models\Classification as Classification;
use App\Models\User as User;
use App\Models\UserLogs as UserLogs;
use App\Models\FileUpload as File;
use App\Models\TechnicalDescription as TechnicalDescriptions;
use App\Models\Email as Emails;
use App\Models\Notifications as Notifications;
use App\Models\NotifReceiver as Receiver;
use App\Models\PusherTrigger as PusherTrigger;
use Carbon\Carbon;
use App\Notifications\Ticket as Notifticket;
use App\Notifications\OffersNotification as OffersNotification;
use App\Events\Notifications as EventNotification;
use Pusher\Pusher;


class TicketController extends Controller
{
    public $department;
    protected $ticket;
    public $priority;
    public $status;
    public $user;
    public $issue;
    public $class;
    public $userlog;
    public $file;
    public $notif;
    public $notif_receiver;
    public $email;
    public $technicaldescription;
    public $pusher;


    public function __construct(Ticket $ticket)
    {
        $this->department = new Department;
        $this->ticket =$ticket;
        $this->priority = new Priority;
        $this->status = new Status;
        $this->user = new User;
        $this->issue = new Issue;
        $this->class = new Classification;
        $this->userlog = new UserLogs;
        $this->file = new File;
        $this->email = new Emails;
        $this->notif = new Notifications;
        $this->notif_receiver = new Receiver;
        $this->technicaldescription = new TechnicalDescriptions;
        $this->pusher =new PusherTrigger;
    }

    public function TriggerPusher($id){
        $data =  $id;
        $this->pusher->trigger('Tickets', 'new-ticket', $data);
    }

    public function TicketCode($branch){

        $currentDate = new \DateTime();
        $this->ticket->created = now();
        $tcounter = $this->ticket->TicketCount()[0];
        $code = strval((string) ($tcounter->tcount % 999) . "" . session()->get("user")->id);
        $count = str_repeat("0", 5 - strlen($code)).$code;
        $timestamp = strval($currentDate->format('ymd')) . "-" .$count;
        $ticket_code = strtoupper(substr($branch, 0, 3)) . $timestamp;


        return $ticket_code;
    }

    public function inboxpage()
    {
        if (session()->has("user")) {
            $this->ticket->department_id = session()->get("user")->Department_id;
            if (session()->get("user")->SERVICE_DESK == 1) {
                return view('Ticket/Inbox')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class);
            } else {
                return redirect("/dashboard");
            }
        }

        return redirect("/");
    }
    public function Closedpage()
    {
        if (session()->has("user")) {
            $this->ticket->department_id = session()->get("user")->Department_id;
            return view('Ticket/Closed')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class);
        }
        return redirect("/");

    }
    public function CanceledandDisapprovepage()
    {
        if (session()->has("user")) {
            $this->ticket->department_id = session()->get("user")->Department_id;
            return view('Ticket/CanceledOrDisapproved')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class);
        }
        return redirect("/");
    }
    public function mytickets()
    {
        if(session()->has("user")) {
            $this->ticket->user_id = session()->get("user")->id;
            return view('Ticket/MyTickets')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class)->with('file', $this->class);
        }
        return redirect("/");

    }
     public function testingpage()
    {
        if(session()->has("user")) {
            $this->ticket->user_id = session()->get("user")->id;
            return view('testing page')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class)->with('file', $this->class);
        }
        return redirect("/");

    }

    public function TicketDetails($tid)
    {

    try{

        $this->ticket->ticket_code=$tid;
      if ($this->ticket->getTicketDetails()->getContent() !== "[]" && $this->ticket->getTicketDetails()->getContent() !== '') {
            $data = json_decode($this->ticket->getTicketDetails()->getContent())[0];
      } else {
            return redirect("/inbox");
      }
        if(session()->has("user")) {
            $this->file->ticket_id = strval($tid);
             // $this->file->ticket_id = strval($tid);
            $this->class->depid = session()->get('user')->Department_id;
            $this->issue->dept_id = session()->get('user')->Department_id;
            return view('Ticket/Details')->with('department', $this->department)->with('ticket', $this->ticket)->with('user', $this->user)->with('file', $this->file)->with('data', $data)->with('status', $this->status)->with('class', $this->class)->with('priority', $this->priority)->with('issue', $this->issue);
        }
        return redirect("/");
    }catch(\Exception $e){
        dd($e->getMessage());

    }

    }
    public function createpage()
    {
        if (session()->has("user")) {
            return view('Ticket/Create')->with('department', $this->department)->with('ticket', $this->ticket);
        }
        return redirect("/");
    }

    public function AddTicket(Request $request)
    {
        // $ticket = new Self();
        try {
            $currentDate = new \DateTime();
            $timestamp = strval($currentDate->format('ymd')) . "-" . strval($currentDate->format('U'));
            $this->ticket->ticket_code = $this->TicketCode($request->input("branch_department_name"));
            $this->ticket->tname = $request->input("name");
            $this->ticket->status_id = 1;
            $this->ticket->created = now();
            $this->ticket->updated = now();

            if ($request->hasFile('files')) {
                $files = $request->file('files');
                if (is_array($files)) {
                    // Multiple files uploaded
                    foreach ($files as $file) {
                        // Handle each file individually
                        $this->handleUploadedFile($file, $this->ticket->ticket_code);
                    }

                } else {
                    // Single file uploaded
                    $this->handleUploadedFile($files, $this->ticket->ticket_code);
                }
            }
            ///
            $this->ticket->request = $request;
            $this->email->request = $request;
            $this->notif->request = $request;
            $this->userlog->userid = $request->input('id');
            $this->userlog->ticketid = $request->input('ticket_id');
            $this->userlog->statusid = 1;
            $this->userlog->remarks = "Ticket Created";
            $this->userlog->added = now();
            $this->userlog->AddUserLogs();

            // $this->email->did = $request->input("branch_department");
            // $this->email->sendtoDepartment();
            // notification section see NotifContent(num) function
            $this->notif->tcode = $this->TicketCode($request->input("branch_department_name"));
            $this->notif->type = 1;
            $this->notif->status_id = 1;
            $this->notif->updated = now();
            $this->notif->created = now();
            // set receiver
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            $this->email->did = session()->get('user')->Department_id;
            foreach ($this->email->GetEmails() as $res) {
                if ($res->SERVICE_DESK == 1) {
                    $this->notif_receiver->userid = $res->id;
                    $this->notif_receiver->updated = now();
                    $this->notif_receiver->created = now();
                    $this->notif_receiver->AddReceiver();
                    // pusher trigger
                    $this->pusher->id=$res->id;
                    $this->pusher->NewticketTrigger();
                    // end
                }
            }

            return $this->ticket->AddTicket() . "\n " . $this->email->result . "\n " . $this->notif_receiver->results;
        }catch (\Exception $e){
            return "controller error".$e->getMessage()."  ".$e->getLine();
        }

    }
    public function handleUploadedFile($file, $tcode)
    {
        // Set the destination path where the file will be stored
        $destinationPath = public_path('storage/uploads');
        // Generate a unique name for the file
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        // Move the uploaded file to the destination path
        $file->move($destinationPath, $fileName);
        // You can store the file path or perform any other operations here
        $this->ticket->addfile($fileName, $tcode);
    }
    
    public function TicketInstruction(Request $request)
    {
        try {
            //           // set token
            if ($request->input('status') == "2") {
                $randomNumber = mt_rand(1000, 9999);
                $this->userlog->token = str($randomNumber) . $request->input('id');
                session()->put("userlog_token", $this->userlog->token);
            } else {
                $this->userlog->token = $request->input("userlog_token");
            }
            $this->ticket->request = $request;
            $this->userlog->request = $request;
            $this->notif->request = $request;


            ///set value for add user log function
            $this->userlog->userid = session()->get("user")->id;
            $this->userlog->ticketid = $request->input('id');
            $this->userlog->statusid = $request->input('status');
            $this->userlog->remarks = $request->input('remarks') == null ? "" : $request->input('remarks');
            $this->userlog->added = now();

            // add notification
            $this->notif->tcode = $request->input("tcode");
            $this->notif->type = 1;
            $this->notif->receiver_type = 1;
            $this->notif->status_id = 2;
            $this->notif->updated = now();
            $this->notif->created = now();

            // set receivers
            //set requester notifications
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            $this->notif_receiver->userid = $request->input('requester-id');
            $this->notif_receiver->updated = now();
            $this->notif_receiver->created = now();
            $this->notif_receiver->AddReceiver();

            // trigger the pusher event
            $this->pusher->id=$request->input('requester-id');
            $this->pusher->NewticketTrigger();

            //set assignee notifications
            $this->notif->receiver_type = 3;
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            $this->notif_receiver->userid = $request->input('employee');
            $this->notif_receiver->AddReceiver();

            // // trigger the pusher event
            $this->pusher->id=$request->input('employee');
            $this->pusher->NewticketTrigger();

            ///set viewers notifications
            $this->notif->receiver_type = 3;
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            foreach (json_decode($request->input("viewers-id")) as $res) {
                if (!is_null($res->viewer)) {
                    $this->notif_receiver->userid = $res->viewer;
                    $this->notif_receiver->AddReceiver();
                    //pusher trigger event
                    $this->pusher->id=$res->viewer;
                    $this->pusher->NewticketTrigger();
                }
            }



            //execute function
            $this->ticket->SetInstruction();
            $this->userlog->AddUserLogs();
            return $this->userlog->result . " " . $this->notif_receiver->results . " " . $this->notif->results;
        }catch (\Exception $e){
            return $e->getMessage() . " " . $e->getLine();
        }
    }
    public function TaskPage()
    {
        if (session()->has("user")) {
            return view('Ticket/Task')->with('ticket', $this->ticket)->with('user', $this->user)->with('status', $this->status);
        }
        return redirect("/");
    }
     public function TransmitalApproveOrReject(Request $request)
    {
        $this->ticket->request = $request;
        $this->ticket->UpdateState();
        return  $this->ticket->result;
    }
    public function Transmital(Request $request)
    {
        try{
            ///userlogs token
         $randomNumber = mt_rand(1000, 9999);
        //ticket properties
        $this->ticket->request = $request;
        $this->ticket->status_id = 2;
        $this->ticket->ticketid = $request->input('ticket_id');
        // userlog properties
        $this->userlog->userid = $request->input('user_id');
        $this->userlog->ticketid = $request->input('ticket_id');
        $this->userlog->statusid = 13;
        $this->userlog->remarks = $request->input('remarks')."\n\n<div>transfer the task to: <span style='color:blue'>".$request->input('new_assignee')."</span></div>";
        $this->userlog->token= str($randomNumber) . $request->input('ticket_id');
            $this->userlog->added = now();
        $this->ticket->request = $request;

            // add notification
            $this->notif->request = $request;
            $this->notif->tcode = $request->input("tcode");
            $this->notif->type = 3;
            $this->notif->updated = now();
            $this->notif->created = now();
            // set receivers
            //set requester notifications
            $this->notif->receiver_type = 1;
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            $this->notif_receiver->userid = $request->input('requester-id');
            $this->notif_receiver->updated = now();
            $this->notif_receiver->created = now();
            $this->notif_receiver->AddReceiver();
            // trigger pusher
            $this->pusher->id=$request->input('uid');
            $this->pusher->TransferTrigger();

            //set assignee notifications
            $this->notif->receiver_type = 3;
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            $this->notif_receiver->userid = $request->input('uid');
            $this->notif_receiver->AddReceiver();

            // trigger pusher
            $this->pusher->id=$request->input('uid');
            $this->pusher->TransferTrigger();
            ///set viewers notifications
            $this->notif->receiver_type = 3;
            $this->notif_receiver->notifid = $this->notif->AddNotifications();




            //function execution
        $this->ticket->TransferTask();
        $this->ticket->UpdateState();
        $this->userlog->AddUserLogs();
        return  $this->ticket->result." ".$this->userlog->result;
        }catch(\Exception $e){
            return $e->getMessage();
        }




    }
    public function UpdateStatus(Request $request)
    {
        try {
            // set token
            if ($request->input('status') == "2") {
                $randomNumber = mt_rand(1000, 9999);
                $this->userlog->token = str($randomNumber) . $request->input('id');
            } else {
                $this->userlog->token = $request->input("userlog_token");
            }
            //pass
            ///set value for add user log function
            $this->userlog->userid = session()->get("user")->id;
            $this->userlog->ticketid = $request->input('id');
            $this->userlog->statusid = $request->input('status');
            $this->userlog->remarks = $request->input('remarks') == null ? "" : $request->input('remarks');
            $this->userlog->added = now();

            // ticket update
            $this->ticket->status_id = $request->input('status');
            $this->ticket->ticketid = $request->input('id');
            $this->ticket->UpdateState();

            if ($request->input('working-time') != null) {
                $this->ticket->workingtime = $request->input('working-time');
                $this->ticket->UpdateWorkingTime();
            }

            if ($request->input('duedate') != null) {
                $this->ticket->tdeudate = $request->input('duedate');
                $this->ticket->updateDueDate();
            }

            //set the content of the notifications
            $this->notif->tcode = $request->input("tcode");
            $this->notif->type = 1;
            $this->notif->receiver_type = 1;
            $this->notif->status_id = intval($request->input('status')) == 2 ? 21 : intval($request->input('status'));
            $this->notif->updated = now();
            $this->notif->created = now();

            //set who to send the notifications
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            $this->notif_receiver->userid = $request->input('requester-id');
            $this->notif_receiver->updated = now();
            $this->notif_receiver->created = now();
            $this->notif_receiver->AddReceiver();
            $this->pusher->id=$request->input('requester-id');
            $this->pusher->NewticketTrigger();

            //set approver notifications
            if (intval($request->input('status')) == 5 || intval($request->input('status')) == 7) { //only triggerred if the status is cancel request and for approval
                $this->notif->receiver_type = 4;
                $this->notif_receiver->notifid = $this->notif->AddNotifications();

                $this->email->did = session()->get('user')->Department_id;
                foreach ($this->email->GetEmails() as $res) {
                    if ($res->APPROVER == 1) {
                        $this->notif_receiver->userid = $res->id;
                        $this->notif_receiver->AddReceiver();
                        $this->pusher->id=$res->id;
                        $this->pusher->NewticketTrigger();
                    }
                }
            }

            //Function
            $this->userlog->AddUserLogs();
            return $this->userlog->result . " " . $this->notif_receiver->results . " " . $this->notif->results;
        } catch (\Exception $e) {
            return $e->getMessage();

        }
    }
    public function GetTickets($depid, $user_id)
    {
        $this->ticket->department_id=$depid;
        $this->ticket->user_id = $user_id;
        return   $this->ticket->getTickets();
    }
    public function GetAllTickets($depid, $assignee)
    {
        $this->ticket->department_id = $depid;
        $this->ticket->assignee = $assignee;
        return $this->ticket->getAllTickets();
    }
    public function GetMyticket($uid)
    {
        $this->ticket->user_id=$uid;
        return   $this->ticket->getTickets();
    }
    public function ReOpenOrClose($sid, $tid, $token, $uid)
    {
        if ($sid == 2) {
            $randomNumber = mt_rand(1000, 9999);
            $this->userlog->token = str($randomNumber) . $tid;
            session()->put("userlog_token", $this->userlog->token);
        } else {
            $this->userlog->token = $token;
        }

        $this->ticket->status_id = $sid;
        $this->ticket->ticketid = $tid;

        $this->userlog->userid = $uid;
        $this->userlog->ticketid = $tid;
        $this->userlog->statusid = $sid;
        $this->userlog->remarks = "";
        $this->userlog->added = now();
        $this->userlog->AddUserLogs();
        return $this->ticket->UpdateState() . " " . $this->userlog->result;
    }
    public function TaskGetter($uid,$did)
    {
        $this->ticket->user_id=$uid;
        $this->ticket->department_id=$did;

        return   $this->ticket->getTasks();

    }

     public function EditTicket(Request $request)
    {
        $this->ticket->tname=$request->input('name');
        $this->ticket->tposition=$request->input('position');
        $this->ticket->temail=$request->input('email');
        $this->ticket->trequester=$request->input('branch_department');
        $this->ticket->treceiver=$request->input('addressto');
        $this->ticket->ticketid=$request->input('id');
        $this->ticket->tsubject=str_replace(["`"], "'",$request->input('subject'));
        $this->ticket->tdescription=str_replace(["`"], "'",$request->input('descrip'));
        $this->ticket->user_id = $request->input('uid');
        ///userlogs
        $this->userlog->token = "";
        $this->userlog->userid =  $request->input('uid');
        $this->userlog->ticketid = $request->input('id');
        $this->userlog->statusid = 8;
        $this->userlog->remarks =  $request->input('remarks');
        $this->userlog->added = now();
        $this->userlog->AddUserLogs();
        //end
        // add notification
        $this->notif->request = $request;
        $this->notif->tcode = $request->input("tcode");
        $this->notif->type = 1;
        $this->notif->receiver_type = 1;
        $this->notif->status_id = 8;
        $this->notif->updated = now();
        $this->notif->created = now();

        // set receivers
        //set requester notifications
        $this->notif_receiver->notifid = $this->notif->AddNotifications();
        $this->notif_receiver->userid = $request->input('requester-id');
        $this->notif_receiver->updated = now();
        $this->notif_receiver->created = now();
        $this->notif_receiver->AddReceiver();
        //set assignee notifications
        $this->notif->receiver_type = 3;
        $this->notif_receiver->notifid = $this->notif->AddNotifications();
        $this->notif_receiver->userid = $request->input('employee');
        $this->notif_receiver->AddReceiver();
        ///set viewers notifications
        $this->notif->receiver_type = 3;
        $this->notif_receiver->notifid = $this->notif->AddNotifications();
        foreach (json_decode($request->input("viewers-id")) as $res) {
            if (!is_null($res->viewer)) {
                $this->notif_receiver->userid = $res->viewer;
                $this->notif_receiver->AddReceiver();
            }
        }






        $this->ticket->EditTicket();
        return $this->ticket->result . " " . $this->userlog->result . " " . $this->notif->results;

    }
     public function GetClosedTickets($did,$uid)
    {
        try{
            $this->ticket->department_id=$did;
            $this->ticket->user_id=$uid;
            $this->ticket->getClosedTicket();
            return   $this->ticket->result;
        }catch(\Exception $e){
            return $e->getMessage();

        }

    }
    public function GetCanceledandDisapproveTickets($did, $uid)
    {
        try {
            $this->ticket->department_id = $did;
            $this->ticket->user_id = $uid;
            $this->ticket->getCanceledandDisapprovedTicket();
            return $this->ticket->result;
        } catch (\Exception $e) {
            return $e->getMessage();

        }

    }
     public function ViewPage()
    {
        if (session()->has("user")) {
            return view('Ticket/View')->with('ticket', $this->ticket)->with('user', $this->user)->with('status', $this->status);
        }
        return redirect("/");
    }
     public function UpdatePrioClassIssue(Request $request)
    {
        $this->ticket->classid=$request->input('class');
        $this->ticket->issueid=$request->input('issue');
        $this->ticket->prioid=$request->input('priority');
        $this->ticket->ticketid=$request->input('id');

        ///userlogs
        $this->userlog->token = $request->input('token');
        $this->userlog->userid =  $request->input('uid');
        $this->userlog->ticketid = $request->input('id');
        $this->userlog->statusid = 8;
        $this->userlog->remarks =  $request->input('remarks');
        $this->userlog->added = now();
        $this->userlog->AddUserLogs();
        //end
        $this->ticket->UpdatePrioClassIssue();
        return $this->ticket->result . " " . $this->userlog->result;

    }
    public function addTechnicalDescription(Request $request)
    {
        try {
            $this->technicaldescription->content = $request->input('description');
            $this->technicaldescription->tid = $request->input('ticket_id');
            $this->technicaldescription->recommend = $request->input('recommend');
            $this->technicaldescription->ref_no = $request->input('ref_no');
            $this->technicaldescription->cur_date = now();
            $this->technicaldescription->edit_date = now();
            $this->technicaldescription->addTechnicalDescription();

            return $this->technicaldescription->result;

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function UpdateTechnical(Request $request){
        try{
            $this->technicaldescription->content = $request->input('description');
            $this->technicaldescription->tdid = $request->input('tdid');
            $this->technicaldescription->recommend = $request->input('recommend');
            $this->technicaldescription->updateTechnicalDescription();

            return $this->technicaldescription->result;

        }catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
     public function UpdateRefenrence(Request $request){
        try{
            $this->technicaldescription->tdid = $request->input('tdid');
            $this->technicaldescription->ref_no = $request->input('ref_no');
            $this->technicaldescription->updateReferenceNo();


            $this->userlog->token = "";
            $this->userlog->userid =  $request->input('user_id');
            $this->userlog->ticketid = $request->input('ticket_id');
            $this->userlog->statusid = 8;
            $this->userlog->remarks =  "<span class='text-success'> Update Technical Report Reference No. </span> \n \n From: <span class='text-warning'>".$request->input('last_ref_no')." </span> \n To: <span class='text-danger  '>".$request->input('ref_no')."</span>";
            $this->userlog->added = now();
            $this->userlog->AddUserLogs();

            return $this->technicaldescription->result;

        }catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function SearchTicket($keyword){
        try{
            $this->ticket->keyword=$keyword;
            $this->ticket->SearchTicket();

            return $this->ticket->result;

        }catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
    public function PusherTester(){
        event(new EventNotification("test connection"));
        return "Event has been sent!";
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viewers as Viewers;
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
use App\Models\Comment as Commment;
use App\Models\Notifications as Notifications;
use App\Models\NotifReceiver as Receiver;
use App\Models\PusherTrigger as PusherTrigger;
use Carbon\Carbon;

class ViewersController extends Controller
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
    public $viewers;
    public $comments;
    public $notif;
    public $notif_receiver;
      public $pusher;

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
        $this->viewers = new Viewers;
        $this->comments = new Commment;
        $this->notif = new Notifications;
        $this->notif_receiver = new Receiver;
        $this->pusher =new PusherTrigger;
    }
    public function AddViewers(Request $request, $tid, $token, $tcode)
    {
        try{

            ////user logs add
            $this->userlog->token = $token;
            $this->userlog->userid = session()->get("user")->id;
            $this->userlog->ticketid = $tid;
            $this->userlog->statusid = 8;
            $this->userlog->remarks = "Added as a Viewer:";
            $this->userlog->added = now();

            ///set viewers notifications
            $this->notif->tcode = $tcode;
            $this->notif->type = 4;
            $this->notif->receiver_type = 5;
            $this->notif->updated = now();
            $this->notif->created = now();
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            foreach (json_decode($request->input("viewers-data")) as $res) {
                $this->viewers->uid = $res->id;
                $this->userlog->remarks .= "\n<em>" . $res->name . " from " . $res->department_name . '</em>';
                $this->viewers->tid=$tid;
                $this->viewers->AddViewers();
                $this->notif_receiver->userid = $res->id;
                $this->notif_receiver->created= now();
                $this->notif_receiver->AddReceiver();
            }
            //add notification


            //set requester notifications
            $this->notif->receiver_type = 1;
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            $this->notif_receiver->userid = $request->input('requester-id');
            $this->notif_receiver->updated = now();
            $this->notif_receiver->created = now();
            $this->notif_receiver->AddReceiver();

            // trigger the  pusher to update the ticket page with new data
            $this->pusher->id=$request->input('requester-id');
            $this->pusher->ViewerTrigger();
            //set assignee notifications
            $this->notif->receiver_type = 3;
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            $this->notif_receiver->userid = $request->input('assignee-id');
            $this->notif_receiver->AddReceiver();

            // trigger the  pusher to update the ticket page with new data
             $this->pusher->id=$request->input('assignee-id');
            $this->pusher->ViewerTrigger();



            //execute function
            $this->userlog->AddUserLogs();
            $this->comments->AddComment();


            return $this->userlog->result . " " . $this->notif->results;
        }catch(\Exception $e){
            return $e->getLine();
        }


    }
     public function GetViewers($uid,$tid){
        // return $request->all();
        try{

                $this->viewers->uid=$uid;
                $this->viewers->tid=$tid;
                $this->viewers->getViewers();

            return $this->viewers->result;
        }catch(\Exception $e){
            return $e->getMessage();
        }


    }
    public function getAllUsers(){
        try{
            $this->viewers->getAllUsers();
            return $this->viewers->result;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function DeleteViewers($vid){
        try{
            // $this->userlog->token = $token;
            // $this->userlog->userid = session()->get("user")->id;
            // $this->userlog->ticketid = $tid;
            // $this->userlog->statusid = 8;
            // $this->userlog->remarks = "Added as a Viewer:";
            // $this->userlog->added = now();

            $this->viewers->vid=$vid;
            $this->viewers->DeleteViewers();
            return $this->viewers->result;
        }catch(\Exception $e){
            return $e->getMessage();
        }


    }

}

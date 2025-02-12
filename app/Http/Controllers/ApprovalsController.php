<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLogs as UserLogs;
use App\Models\Approvals as Approvals;
use App\Models\Ticket as Tickets;
use App\Models\Notifications as Notifications;
use App\Models\NotifReceiver as Receiver;



class ApprovalsController extends Controller
{

    //
    public $approvals;
    public $userlogs;
    public $tickets;
    public $notif;
    public $notif_receiver;


    public function __construct()
    {

        $this->approvals = new Approvals;
        $this->userlogs = new UserLogs;
        $this->tickets = new Tickets;
        $this->notif = new Notifications;
        $this->notif_receiver = new Receiver;
    }

    public function ApprovedOrDisapproved(Request $request)
    {
        // return dd($request);

        try {
            switch ($request->input('status_id')) {
                case '5':
                    $newstate = $request->input('status') == '9' ? 10 : 2;
                    $remarks = $request->input('status') == '9' ? $request->input('remarks') . "\n Approve the Request for Task Cancelation" : $request->input('remarks') . "\nReject the Request for Task Cancelation";
                    $remarks1 = $request->input('status') == '9' ? "Canceled" : "Reject";
                    break;
                case '7':
                    $newstate = $request->input('status') == '9' ? 2 : 11;
                    $remarks = $request->input('status') == '9' ? $request->input('remarks') . "\n Approve the Request for Task Approval" : $request->input('remarks') . "\n Reject the Request for Task Approval";
                    $remarks1 = $request->input('status') == '9' ? "Approved" : "Disapproved";
                    break;
            }

            $randomNumber = mt_rand(1000, 9999);
            $this->approvals->userlog_id = intval($request->input('sid_update'));
            $this->approvals->approval = $request->input('status') == '9' ? 1 : 2;
            $this->approvals->daterecord = now();
            //
            $this->userlogs->ticketid = $request->input('id');
            $this->userlogs->userid = $request->input('uid');
            $this->userlogs->remarks = $remarks;
            $this->userlogs->statusid = $request->input('status');
            $this->userlogs->token = str($randomNumber) . $request->input('id');
            $this->userlogs->added = now();
            $this->userlogs->AddUserLogs();

            $this->userlogs->remarks = $remarks1;
            $this->userlogs->statusid = $newstate;
            $this->userlogs->AddUserLogs();
            //
            $this->tickets->status_id = $newstate;
            $this->tickets->ticketid = $request->input('id');

            //set the content of the notifications
            $this->notif->tcode = $request->input("tcode");
            $this->notif->type = 1;
            $this->notif->receiver_type = 1;
            $this->notif->status_id = $newstate == 2 ? 9 : $newstate;
            $this->notif->updated = now();
            $this->notif->created = now();

            //set who to send the notifications
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            $this->notif_receiver->userid = $request->input('assignee-id');
            $this->notif_receiver->updated = now();
            $this->notif_receiver->created = now();
            $this->notif_receiver->AddReceiver();


            $this->approvals->ForApproval();
            // $this->userlogs->AddUserLogs();
            $this->tickets->UpdateState();

            return $this->approvals->result . " " . $this->userlogs->result;
        } catch (\Exception $e) {
            return $e->getMessage();

        }


    }

}

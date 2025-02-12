<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
class Notifications extends Model
{
    use HasFactory;

    public $tcode;
    public $type;
    public $request;
    public $status_id;
    public $content;
    public $created;
    public $updated;
    public $results;
    public $uid;
    public $tnid;
    public $receiver_type;
    public  $lastInsertedId;

    public function AddNotifications()
    {
        try {
            $this->content = $this->NotifContent();
            DB::select('CALL AddTicketNotifications(?, ?, ?, ?, ?)', [$this->tcode, $this->type, $this->content, $this->created, $this->updated]);
            $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            $this->results = "Notification Added";
            return $this->lastInsertedId;
        } catch (\Exception $e) {
            $this->results = $e->getMessage();
        }
    }
    public function GetNotifications()
    {
        try {
            $this->results = DB::select('CALL GetNotifications(?,?)', [$this->uid, $this->tnid]);
            return $this->results;
        } catch (\Exception $e) {
            $this->results = $e->getMessage();
        }
    }
      public function GetReadNotifications()
    {
        try {

            $this->results = DB::select('CALL GetReadNotification(?, ?)', [$this->uid, $this->type]);
            return $this->results;
        } catch (\Exception $e) {
            $this->results = $e->getMessage();
        }
    }

      public function GetUnReadNotifications()
    {
        try {

            $this->results = DB::select('CALL GetUnReadNotification(?, ?)', [$this->uid, $this->type]);
            return $this->results;
        } catch (\Exception $e) {
            $this->results = $e->getMessage();
        }
    }
 public function NotifContent()
{
    // Initialize content variable
    $content = "";

    // Switch based on notification type
    switch ($this->type) {
        case 1:
            // Notification type: Change state
               switch ($this->status_id) {
                case 1:
                    // New ticket created
                    $content = "A new ticket has been created by " . $this->request->input('name') . " from " . $this->request->input('from_branch_department_name') . " with Ticket Code " . $this->tcode;
                    break;
                case 2:
                    // Ticket assigned
                    switch ($this->receiver_type) {
                        case 1:
                            $content = "Your Ticket {$this->tcode} has been assigned to " . $this->request->input('assignee-name');
                            break;
                        case 3:
                            $content = "The Ticket {$this->tcode} has been assigned to you";
                            break;
                        case 5:
                            $content = "The Ticket {$this->tcode} has been assigned to " . $this->request->input('assignee-name') . ", and you are a viewer";
                            break;
                    }
                    break;
                case 3:
                    // Ticket ongoing
                    $content = "Your Ticket {$this->tcode} is currently ongoing";
                    break;
                case 4:
                    // Ticket on hold
                    $content = "Your Ticket {$this->tcode} is currently on hold";
                    break;
                case 5:
                    // Cancel request
                    switch ($this->receiver_type) {
                        case 1:
                            $content = "Your Ticket {$this->tcode} is currently under cancellation request";
                            break;
                        case 4:
                            $content = "The Ticket {$this->tcode} is currently under cancellation request, and it needs your approval";
                            break;
                    }
                    break;
                case 6:
                    // Close request
                    $content = "Your Ticket {$this->tcode} is on close request. Please test or review if the issue is resolved before approving or reopening this ticket.";
                    break;
                case 7:
                    // For approval
                    switch ($this->receiver_type) {
                        case 1:
                            $content = "Your Ticket {$this->tcode} is currently for approval";
                            break;
                        case 4:
                            $content = "The Ticket {$this->tcode} is currently for approval, and it needs your approval";
                            break;
                    }
                    break;
                case 8:
                    // Ticket updated
                    $content = $this->request->input('uname') . " updated the Ticket {$this->tcode}";
                    break;
                case 9:
                    // Ticket approved
                    $content = "Your Ticket {$this->tcode} has been approved";
                    break;
                case 10:
                    // Ticket approved and canceled
                    $content = "Your Ticket {$this->tcode} has been both approved and canceled";
                    break;
                case 11:
                    // Ticket disapproved
                    $content = "Your Ticket {$this->tcode} has been disapproved";
                    break;
                case 14:
                    // Task closed and resolved
                    $content = "Your Task {$this->tcode} is now closed and resolved";
                    break;
                case 15:
                    // Ticket forwarded
                    switch ($this->receiver_type) {
                        case 1:
                            $content = "Your Ticket {$this->tcode} has been forwarded to other departments for processing";
                            break;
                        case 5:
                            $content = "The Ticket {$this->tcode} is now forwarded";
                            break;
                    }
                    break;
                case 21:
                    // Ticket request rejected and reopened
                    $content = "Your request for the Ticket {$this->tcode} has been rejected and it is now reopened";
                    break;
            }
            break;
        case 2:
            // Notification type: Comments
            $content = "<span class='text-success'>" . session()->get('user')->name . "</span> has commented on Ticket <i class='flaticon-comment icon-nm text-success'></i> {$this->tcode}";
            break;
        case 3:
            // Notification type: Transfer
            switch ($this->receiver_type) {
                case 1:
                    $content = "Your Ticket <i class='flaticon-file-2 icon-nm text-warning'></i> {$this->tcode} has been transferred to " . $this->request->input('new_assignee');
                    break;
                case 3:
                    $content = "<span class='text-warning'>" . session()->get('user')->name . "</span> transferred the Ticket <i class='flaticon-file-2 icon-nm text-primary'></i> {$this->tcode} to you";
                    break;
            }
            break;
        case 4:
            // Notification type: Add or remove viewer
            switch ($this->receiver_type) {
                case 1:
                    $content .= "Some users have been added as viewers in the Ticket <i class='flaticon-file-2 icon-nm text-warning'></i> {$this->tcode}.<br> <b class='text-danger'>See Logs for more Details</b>";
                    break;
                case 3:
                    $content .= "Some users have been added as viewers in the Ticket <i class='flaticon-file-2 icon-nm text-warning'></i> {$this->tcode}, to which you are assigned. <br> <b class='text-danger'>See Logs for more Details</b>";
                    break;
                case 5:
                    $content = "You have been added as a viewer in a Ticket <i class='flaticon-file-2 icon-nm text-warning'></i> {$this->tcode}";
                    break;
            }
            break;
    }

    // Return the content
    return $content;
}











}

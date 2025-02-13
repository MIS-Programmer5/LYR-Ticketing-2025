<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment as Commment;
use App\Models\CommentAttachments as CommentAttachments;
use Illuminate\Support\Facades\DB;
use App\Models\Notifications as Notifications;
use App\Models\NotifReceiver as Receiver;
use App\Models\PusherTrigger as PusherTrigger;
use Carbon\Carbon;

class CommentController extends Controller
{
    public $comments;
    public $attach;
    public $notif;
    public $notif_receiver;
    public $pusher;

    public function __construct(){
        $this->comments = new Commment();
        $this->attach = new CommentAttachments();
        $this->notif = new Notifications;
        $this->notif_receiver = new Receiver;
        $this->pusher =new PusherTrigger;
    }
    public function getComments($tid){
        $this->comments->ticketid=$tid;
       return  $this->comments->GetComments();
    }
    public function AddComments(Request $request){
        try {

            $this->comments->request = $request;
            $this->comments->content = $request->input('comment') == null ? "" : $request->input('comment');
            $this->comments->ticketid=$request->input('tid');
            $this->comments->userid=$request->input('uid');
            $this->comments->added = now();
            $this->comments->edited = now();
            $this->comments->AddComment();

            $lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            if ($request->hasFile('files')) {
                $files = $request->file('files');

                if (is_array($files)) {
                    // Multiple files uploaded
                    foreach ($files as $file) {
                        // Handle each file individually
                        $this->handleUploadedFile($file, $lastInsertedId);
                    }
                } else {
                    // Single file uploaded
                    $this->handleUploadedFile($files, $lastInsertedId);
                }
            }

            //set the content of the notifications
            $this->notif->tcode = $request->input("tcode");
            $this->notif->type = 2;
            $this->notif->status_id = 0;
            $this->notif->updated = now();
            $this->notif->created = now();
            $this->notif->receiver_type = 1;
            //set who to send the notifications
            $this->notif_receiver->notifid = $this->notif->AddNotifications();
            // send notif to assignee
            $this->notif_receiver->updated = now();
            $this->notif_receiver->created = now();
            
            if(session()->get("user")->id != $request->input('assignee-id')){
                $this->notif_receiver->userid = $request->input('assignee-id');

                $this->notif_receiver->AddReceiver();
                $this->pusher->id=$request->input('assignee-id');
                $this->pusher->CommentTrigger();
            }
            // send notif to requester
             if(session()->get("user")->id != $request->input('requester-id')){
                $this->notif_receiver->userid = $request->input('requester-id');
                $this->notif_receiver->AddReceiver();
                $this->pusher->id = $request->input('requester-id');
                $this->pusher->CommentTrigger();
             }

            foreach (json_decode($request->input("viewers-id")) as $res) {

                if (!is_null($res->viewer)) {
                       if(session()->get("user")->id != $res->viewer){
                        $this->notif_receiver->userid = $res->viewer;
                        $this->notif_receiver->AddReceiver();
                        $this->pusher->id = $res->viewer;
                        $this->pusher->CommentTrigger();
                       }
                }
            }


            return $this->comments->results . " " . $this->notif_receiver->results;
        } catch (\Exception $e) {

            return $e->getLine()." ".$e->getMessage();

        }
    }

    public function handleUploadedFile($file, $cid)
    {
        try {
            // Set the destination path where the file will be stored
            $destinationPath = public_path('storage/uploads/comments');
            // Generate a unique name for the file
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Move the uploaded file to the destination path
            $file->move($destinationPath, $fileName);
            // return $destinationPath;
            $this->attach->comid = $cid;
            $this->attach->filename = $fileName;
            $this->attach->addAttachments();
        } catch (\Exception $e) {
            return dd($e->getMessage());

        }
    }
    public function getAttachment($tid)
    {
        try {
            $this->attach->ticketid = $tid;
            $this->attach->getAttachments();
            return $this->attach->result;
        } catch (\Exception $e) {
            return $e->getMessage();

        }

    }
}

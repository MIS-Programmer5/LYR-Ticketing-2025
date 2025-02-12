<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\Email as Email;
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
class EmailController extends Controller
{
    public $cc;
    public $email;
    public $department;
    public $ticket;
    public $priority;
    public $status;
    public $user;
    public $issue;
    public $class;
    public $userlog;
    public $file;
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
        // $this->email = new Emails;
    }




    public function index($ccemails,$sentto)
    {
        $mail = new Email();

        $mail->subject('Your email subject');

        $data = [
            'mail' => "this is a test email", // Pass the $mail object to the view
        ];
        $this->cc=$ccemails;
        $this->email=$sentto;

        Mail::send('Email.EmailContent', $data, function ($message) use ($mail) {

            $message->to($this->email);
            if($this->cc!=1) {
                $result=explode(",",$this->cc);
                for ($i = 0; $i < count($result); $i++) {
                    $message->cc($result[$i]);  // Add CC recipient
                }
            }
           // Set CC recipient
            $message->subject($mail->subject);
        });


    }

     public function TestEmail(){
        try{
        //   $user = User::find(27);
        //   $offerData = [
        //         'name' => 'BOGO',
        //         'subject' => 'New Ticket',
        //         'body' => 'You received a new Ticket.',
        //         'thanks' => 'Thank you',
        //         'offerText' => 'Check out the offer',
        //         'offerUrl' => url('/'),
        //         'offer_id' => 007
        //     ];
        //   $user->sendOfferNotification($offerData);
          $email = New Emails;

        //   $email->sent_to="kenosisrigeli@gmail.com";
        //   $email->sendOfferNotification($offerData);
         $email->did=1;
         $email->sendtoDepartment();

        dd($email->results);
        }catch(\Exception $e){
            return  $e->getMessage();
        }
    }

}

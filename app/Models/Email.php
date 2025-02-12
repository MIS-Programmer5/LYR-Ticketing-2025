<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\OfferNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\DB;
use Notification;

class Email extends Model
{
    use HasFactory, Notifiable;

    protected $sent_to;
    protected $name;
    protected $subject;
    protected $description;
    protected $id;
    protected $ticketcode;
    public $did;
    public $results;
    public $request;


    public function sendOfferNotification($offerData)
    {
        try{
            $notification = new OfferNotification($offerData);
            Notification::route('mail', $this->sent_to)->notify($notification);
            $user = User::find(10); // Find the user you're sending the notification to
            if ($user) {
                $user->notify($notification);
            }
        }catch(\Exception $e){
            dd($e->getMessage());

        }
    }

    public function sendtoDepartment()
    {
        try {
              $offerData = [
                'name' => $this->request->input('name'),
                'sender' => $this->request->input('name'),
                'subject' => "New Ticket".$this->request->input('subject'),
                'body' => $this->request->input('description'),
                'email' => $this->request->input('company_email'),
                'thanks' => 'Thank you',
                'offerText' => 'MIS Ticketing System',
                'offerUrl' => url('/'),
                'offer_id' => 007
            ];

            $this->results = $this->GetEmails();
            // foreach ($this->results as $res) {
            $this->sent_to = "kenosisrigeli@gmail.com";
            $this->sendOfferNotification($offerData);
            // }

          $this->result= "success";

        } catch (\Exception $e) {
            $this->result ="email error ".$e->getMessage()." ".$e->getLine();
        }
    }
    public function GetEmails()
    {
        try {
            $this->results = DB::select('CALL getEmail(?)', [$this->did]);
            return $this->results;
        } catch (\Exception $e) {
            return $e->getMessage();
        }


    }



}

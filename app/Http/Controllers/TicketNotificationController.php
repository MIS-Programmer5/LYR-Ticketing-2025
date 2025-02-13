<?php

namespace App\Http\Controllers;
use Notification;
use Illuminate\Http\Request;
// use App\Notifications\Ticket;
use App\Notifications\OfferNotification;
use Illuminate\Broadcasting\Channel;
use App\Models\User as User;
use App\Models\Email as Email;
use App\Models\NotifReceiver as Receiver;
use App\Models\Notifications as Notifications;



class TicketNotificationController extends Controller
{
    public $user_id;
    public $status;
    public $receiver;

    public $notif;
    public $notif_receiver;

    public function __construct()
    {
        $this->notif = new Notifications;
        $this->notif_receiver = new Receiver;
    }


    public function sendOfferNotification() {
        $userSchema = User::find(27);
        $email = "kenosisrigeli@gmail.com";

        $offerData = [
            'name' => 'BOGO',
            'subject' => 'New Ticket',
            'body' => 'You received a new Ticket.',
            'thanks' => 'Thank you',
            'offerText' => 'Check out the offer',
            'offerUrl' => url('/'),
            'offer_id' => 007
        ];
        //
        Notification::route('mail', $email)
        ->route('vonage', '5555555555')
        ->route('slack', 'https://hooks.slack.com/services/...')
        ->route('broadcast', [new Channel('channel-name')])
        ->notify(new OfferNotification($offerData));
        // ///
        return "success";
    }

    public function getnotifications()
    {
        try {

            $this->notif->uid = session()->get('user')->id;
            $this->notif->GetNotifications();

            return json_encode($this->notif->results);

        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }
    }

      public function GetReadNotifications($type)
    {
        try {

            $this->notif->uid = session()->get('user')->id;
            $this->notif->type = $type;
            $this->notif->GetReadNotifications();

            return json_encode($this->notif->results);

        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }
    }
      public function GetUnReadNotifications($type)
    {
        try {

            $this->notif->uid = session()->get('user')->id;
            $this->notif->type = $type;
            $this->notif->GetUnReadNotifications();

            return json_encode($this->notif->results);

        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }
    }

    public function UpdateReadAt($nrid, $tcode, $uid)
    {
        try {

            $this->notif_receiver->nrid = $nrid;
            $this->notif_receiver->userid = $uid;
            $this->notif_receiver->tcode = $tcode;
            $this->notif_receiver->readat = now();
            $this->notif_receiver->UpdateReadAt();

            return $this->notif_receiver->results;

        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }
    }
    public function MarkAllasRead($uid,$type)
    {
        try {

            $this->notif_receiver->userid = $uid;
            $this->notif_receiver->type = $type;
            $this->notif_receiver->readat = now();
            $this->notif_receiver->MarkAllasRead();

            return "read at updated";

        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }
    }
}

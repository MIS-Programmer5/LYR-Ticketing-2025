<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pusher\Pusher;
use App\Notifications\DesktopNotification;

class PusherTrigger extends Model
{
    use HasFactory;
    public $pusher; // Instance of pusher client
    public $id;

      public function __construct()
    {
        $this->pusher = new Pusher('b880651e91861397d8a2', 'dc61557ab6b562413208', '1755645', [
            'cluster' => 'ap1',
            'useTLS' => true
        ]);

    }

    public function NewticketTrigger(){
        $this->pusher->trigger('Tickets', 'new-ticket', $this->id);
    }
    public function ViewerTrigger(){
        $this->pusher->trigger('Tickets', 'viewer', $this->id);

    }
     public function CommentTrigger(){
        $this->pusher->trigger('Tickets', 'comment', $this->id);
    }

      public function TransferTrigger(){
        $this->pusher->trigger('Tickets', 'transfer', $this->id);
    }
}

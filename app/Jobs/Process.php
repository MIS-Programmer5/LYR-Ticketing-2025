<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Process implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;
    /**
     * Create a new job instance.
     */
    public function __construct($ticket)
    {
          $this->ticket = $ticket;
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $this->ticket->TransferTask();
    }
}

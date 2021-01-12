<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class sendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $x;
    public function __construct($k)
    {
        $this->x=$k;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      
        
          Mail::raw('mail',  function($message) {
            $message->to($this->x['email'], $this->x['name'])->subject
               ('subscription mail for blog update');
            $message->from('rohit_10029@rediffmail.com','firmway');
         });
        
     
    }
}

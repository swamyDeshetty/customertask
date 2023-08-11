<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNewEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
  {
    $data = $this->details;
    
    Mail::send(['html'=>'demo_email_template'], $data, function($message) use ($data)
    
    {
    
    $message->to('swamybittu649@gmail.com','swamy')
    
    ->subject('This is the test queue');
    
    $message->from('swamybittu649@gmail.com','swamy');
    
    });
  }
}

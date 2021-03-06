<?php

namespace App\Jobs;

use App\Mail\EmailForQueue;
use App\Models\User;
use App\Notifications\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $title;
    protected $email;
    public function __construct($email,$title)
    {
        $this->title = $title;
        $this->email = $email;
    }
 
    public function handle()
    {
        $email = new EmailForQueue($this->title);
        Mail::to($this->email)->send($email);
    }
}

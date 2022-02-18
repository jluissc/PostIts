<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForQueue extends Mailable
{
    use Queueable, SerializesModels;
    protected $title;
    public function __construct($title)
    {
        $this->title = $title;
    }
 
    public function build()
    {
        return $this->from('pepbot.pe@gmail.com','PEPE')
            ->subject($this->title)
            ->view('email.post')
            ->with([
                'title'=> $this->title,
            ]);
    }
}

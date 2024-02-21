<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class addPost extends Mailable
{
    use Queueable, SerializesModels;
  private $data=[];
    /**
     * Create a new message instance.
     * 
    @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Create a new message 
     * 
    @return $this
     */
    public function build(){
        return $this->from("booklib@gmail.com")->subject('A new Story was Added')->view('Emails.Email_add_post',['data'=>$this->data]);
    }
}

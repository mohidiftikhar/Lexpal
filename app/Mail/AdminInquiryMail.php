<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;
    public $name;
    public $description;
    public function __construct($email,$name,$description)
    {
        $this->email = $email;
        $this->name= $name;
        $this->description= $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $useremail = $this->email;
        $username = $this->name;
        $userdescription = $this->description;
        return $this->subject('lexpal@test.com')
            ->view('home.emails.adminemail',compact('useremail','username','userdescription'));
    }
}

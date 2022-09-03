<?php

namespace App\Jobs;

use App\Mail\AdminInquiryMail;
use App\Mail\InquiryMail;
use App\Mail\LicenseChangeMail;
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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $email;
    public $name;
    public $description;
    public function __construct($email,$name,$description)
    {
        $this->email = $email;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        $name = $this->name;
        $description =$this->description;
        Mail::to($email)->send(new InquiryMail($email));
        Mail::to('admin@gmail.com')->send(new AdminInquiryMail($email,$name,$description));
    }
}

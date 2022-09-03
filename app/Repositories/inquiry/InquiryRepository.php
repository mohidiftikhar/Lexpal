<?php

namespace App\Repositories\inquiry;

use App\Jobs\SendEmail;
use App\Mail\AdminInquiryMail;
use App\Mail\InquiryMail;
use App\Models\Inquiry;
use App\Repositories\BaseRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Mail;

class InquiryRepository extends BaseRepository implements InquiryInterface
{
    use DispatchesJobs;
    public function __construct(Inquiry $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
    public function send(string $email,string $name, string $description): bool
    {
        $job = new SendEmail($email,$name,$description);
        $this->dispatch($job);
        return true;
    }
}

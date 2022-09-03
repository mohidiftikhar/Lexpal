<?php

namespace App\Repositories\inquiry;

interface InquiryInterface
{
    public function send(string $email ,string $name, string $description):bool;
}

<?php

namespace App\Repositories\admin;

interface AdminInterface
{
    public function admin_login(array $credentials);
    public function send(string $email):bool;
}

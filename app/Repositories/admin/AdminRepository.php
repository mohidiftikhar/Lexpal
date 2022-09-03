<?php

namespace App\Repositories\admin;
use App\Jobs\SendPasswordResetEmail;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;

class AdminRepository extends BaseRepository implements AdminInterface
{
    use DispatchesJobs;

    protected $model;
    public function __construct(
        User $model
    ) {
        $this->model = $model;
    }
    public function admin_login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id === 1) {
                $data['status'] = true;
                $data['msg'] = 'You have Successfully logged in';
            } else {
                Auth::logout();
                $data['status'] = false;
                $data['msg'] = 'You dont have access rights';
            }

        }else{
            $data['status'] = false;
            $data['msg'] = 'Credentials not match';
        }
        return $data;
    }
    public function send(string $email): bool
    {
        $job = new SendPasswordResetEmail($email);
        $this->dispatch($job);
        return true;
    }
}

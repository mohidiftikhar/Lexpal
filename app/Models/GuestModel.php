<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestModel extends Model
{
    use HasFactory;
    protected $table = 'guest_users';

    protected $guarded = [];
    public $timestamps  = true;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    public $table = 'inquires';
    protected $guarded = [];
    public $timestamps  = false;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable     =   [
        'from',
        'to',
        'is_active',
        'from_file',
        'to_file',
        'table_name',
        'lang_1',
        'lang_2'
    ];
}

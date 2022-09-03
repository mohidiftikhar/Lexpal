<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;
    protected $fillable     =   [
        'language_id',
        'ids',
        'entryword',
        'inflactedform',
        'topic',
        'pos',
        'pos_1',
        'entryword_1',
        'inflactedform_1',
        'dn_type'
    ];
}


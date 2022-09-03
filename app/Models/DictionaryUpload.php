<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryUpload extends Model
{
    use HasFactory;

    protected $fillable =   [
        'language_id',
        'csv_path',
        'status',
        'is_split',
        'versions',
        'json_file',
        'is_current',


        'page',
        'total_page',
        'is_json_completed'
    ];
}

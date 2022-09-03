<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvSpilt extends Model
{
    use HasFactory;
    protected $table = 'csv_parts';
    public $timestamps =false;
    protected $fillable =   [
        'upload_id',
        'csv_path',
        'page',
        'import_records',
        'total_records',
        'is_done'
    ];
}

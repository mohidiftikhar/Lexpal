<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps  = true;
    public function product(){
       return $this->hasMany(Product::class,'id','product_id');
    }
    public function user(){
        $this->belongsTo(User::class);
    }

}
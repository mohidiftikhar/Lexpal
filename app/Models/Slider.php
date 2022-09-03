<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps  = false;
    public function appLinks(){
        return $this->hasMany(SliderLink::class,'slider_id','id');
    }

}

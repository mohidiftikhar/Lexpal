<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderLink extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function appHeading(){
        return $this->belongsTo(App_link::class,'app_link_id','id');
    }
}

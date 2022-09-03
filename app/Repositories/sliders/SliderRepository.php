<?php

namespace App\Repositories\sliders;

use App\Models\Slider;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class SliderRepository extends BaseRepository implements SliderInterface
{
    protected $model;
    public function __construct(Slider $model)
    {
        $this->model= $model;
        parent::__construct($model);
    }

}

<?php

namespace App\Repositories\slider_links;

use App\Models\Link;
use App\Models\SliderLink;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class SliderLinksRepository extends BaseRepository implements SliderLinksInterface
{
    public $model;
    public function __construct(SliderLink $model)
    {
        parent::__construct($model);
    }

}

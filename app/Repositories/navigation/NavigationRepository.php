<?php

namespace App\Repositories\navigation;

use App\Models\NavigationBar;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class NavigationRepository extends BaseRepository implements NavigationInterface
{
    public function __construct(NavigationBar $model)
    {
        parent::__construct($model);
    }

}

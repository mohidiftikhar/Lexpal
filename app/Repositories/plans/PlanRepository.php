<?php

namespace App\Repositories\plans;

use App\Models\Plan;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class PlanRepository extends BaseRepository implements PlanInterface
{
    public function __construct(Plan $model)
    {
        parent::__construct($model);
    }
}

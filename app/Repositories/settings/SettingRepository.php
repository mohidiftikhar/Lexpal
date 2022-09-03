<?php

namespace App\Repositories\settings;

use App\Models\Setting;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class SettingRepository extends BaseRepository implements SettingInterface
{
    protected $model;
    public function __construct(Setting $model)
    {
        $this->model=$model;
        parent::__construct($model);
    }
}

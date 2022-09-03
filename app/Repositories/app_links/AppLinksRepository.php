<?php

namespace App\Repositories\app_links;

use App\Models\App_link;
use App\Repositories\BaseRepository;

class AppLinksRepository extends BaseRepository implements AppLinksInterface
{
    public function __construct(App_link $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
    public function store($data){
        unset($data['_token']);
        return $this->create($data);
    }

}

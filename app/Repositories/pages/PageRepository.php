<?php

namespace App\Repositories\pages;

use App\Models\Page;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class PageRepository extends BaseRepository implements PageInterface
{
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }
}

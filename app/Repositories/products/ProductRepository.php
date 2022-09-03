<?php

namespace App\Repositories\products;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

}

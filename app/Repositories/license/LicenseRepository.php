<?php

namespace App\Repositories\license;

use App\Models\License;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Nullable;

class LicenseRepository extends BaseRepository implements LicenseInterface
{
    public function __construct(License $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
    public function store($data){
        unset($data['_token']);
        return $this->create($data);
    }
    public function checkLicense(string $social_type,string $domain,string $product_type):?string
    {
        $license =$this->findByFieldsWithRelations(['social_type'=>$social_type,'domain_name'=>$domain],['product']);
        return $license->whereHas('product', function($q) use($product_type){
            $q->where('type', $product_type);
        })->first();
    }
}

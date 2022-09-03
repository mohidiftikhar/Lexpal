<?php

namespace App\Repositories\questions;

use App\Models\Question;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class QuestionRepository extends BaseRepository implements QuestionInterface
{
    protected $model;
    public function __construct(Question $model)
    {
        $this->model= $model;
        parent::__construct($model);
    }
}

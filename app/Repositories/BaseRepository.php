<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;
    protected $availableIntegrations;
    protected $clientIntegrations;
    private $client;

    /**
     * @param Model $model
     */
    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getMorphClass()
    {
        return $this->getModel()->getMorphClass();
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->getModel()->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id, $fields = null)
    {
        if ($fields) {
            return $this->getModel()->select($fields)->find($id);
        }

        return $this->getModel()->findOrFail($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->getModel()->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        return $this->getModel()->find($id)->update($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {
        return $this->getModel()->insert($data);
    }

    /**
     * @param $ids
     * @param $data
     * @return void
     */
    public function updateMultiple($ids, $data)
    {
        return $this->getModel()->whereIn('id', $ids)->update($data);
    }

    /**
     * @param $collection
     * @return mixed
     */
    public function firstFromCollection($collection)
    {
        return $collection->first();
    }

    /**
     * @param Collection $collection
     * @return mixed
     */
    public function lastFromCollection(Collection $collection)
    {
        return $collection->last();
    }

    /**
     * @param Collection $collection
     * @return bool
     */
    public function isEmpty(Collection $collection)
    {
        return $collection->isEmpty();
    }

    /**
     * @param array $condition
     * @return mixed
     */
    public function findByFields(array $condition)
    {
        return $this->getModel()->where($condition)->get();
    }

    public function findByFieldsWithRelations(array $condition,array $relations)
    {
        return $this->getModel()->with($relations)->where($condition);
    }

    public function findByFieldsArray($name, $fields)
    {
        return $this->getModel()->whereIn($name, $fields)->get();
    }

    /**
     * @param int $count
     * @param Collection $collection
     * @return Collection
     */
    public function take(int $count, Collection $collection)
    {
        return $collection->take($count);
    }

    /**
     * @param $column
     * @param Collection $collection
     * @return \Illuminate\Support\Collection
     */
    public function pluck($column, Collection $collection)
    {
        return $collection->pluck($column);
    }

    /**
     * @return mixed
     */
    public function latest()
    {
        return $this->getModel()->orderBy('id', 'desc')->limit(1)->first();
    }

    /**
     * @param $dataToCheck
     * @param $additionalData
     * @return mixed
     */
    public function createIfNotExist($dataToCheck, $additionalData = [])
    {
        return $this->getModel()->firstOrCreate($dataToCheck, $additionalData);
    }

    /**
     * @param array $condition
     * @param array $data
     * @return mixed
     */
    public function updateWithCondition(array $condition, array $data)
    {
        return $this->getModel()->where($condition)->update($data);
    }

    /**
     * @param array $condition
     * @return void
     */
    public function deleteByCondition(array $condition)
    {
        return $this->getModel()->where($condition)->delete();
    }
    public function delete(int $id)
    {
       return $this->getModel()->find($id)->delete();
    }
    public function count(){
        return $this->model->count();
    }


}

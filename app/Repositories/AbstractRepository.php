<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
abstract class AbstractRepository
{
    /**
     * @return string
     */
    abstract protected function classModel();

    /**
     * @return Model
     */
    protected function createClass()
    {
        return new ($this->classModel())();
    }

    /**
     * @return mixed
     */
    public function getAll(){
        return $this->classModel()::all();
    }

    /**
     * @param array $with
     * @param array $where
     * @return Model | null
     */
    public function getSingleWithWhere(array $with = [], array $where = []): Model | null
    {
        return $this->classModel()::with($with)->where($where)->first();
    }

    /**
     * @param string $field
     * @param array  $values
     * @return Collection
     */
    public function whereIn(string $field = 'id', array $values = [])
    {
        return $this->classModel()::whereIn($field, $values)->get();
    }

    /**
     * @param array $fields
     * @return Model
     */
    public function insertModel(array $fields)
    {
        $model = $this->createClass()->fill($fields);
        $model->save();
        return $model;
    }

    /**
     * @param Model $model
     * @param       $fields
     * @return Model
     */
    public function updateModel(Model $model, $fields)
    {
        $model->fill($fields)->save();
        return $model;
    }
}
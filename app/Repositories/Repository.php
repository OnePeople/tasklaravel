<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Abstract Repository for models.
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param  Model | null $model
     * @throws \Exception
     */
    public function __construct($model = null)
    {
        $this->makeModel($model);
    }

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    abstract public function model():string;

    /**
     * @param  Model | null $model
     * @return Model
     */
    public function makeModel($model):Model
    {
        if (!$model) {
            $model = app()->make($this->model());
        }
        return $this->setModel($model);
    }

    /**
     * Get the associated model.
     *
     * @return Model
     */
    public function getModel():Model
    {
        return $this->model;
    }

    /**
     * Set the associated model.
     *
     * @param  $model Model
     * @return Model
     */
    public function setModel($model):Model
    {
        $this->model = $model;

        return $model;
    }

    /**
     * @param  array $attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Find the record with the given id.
     *
     * @param  int $id
     * @return Model | null
     */
    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get all instances of model.
     *
     * @return Collection
     */
    public function all():Collection
    {
        return $this->model->all();
    }

    /**
     * Update record in the database.
     *
     * @param  array  $data
     * @param  $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        return  $this->model->find($id)->update($data);
    }

    /**
     * Remove record from the database.
     *
     * @param  int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id):bool
    {
        return $this->model->find($id)->delete();
    }
}

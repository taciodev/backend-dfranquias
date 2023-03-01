<?php

namespace App\Repositories\Eloquent;

class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function get($code)
    {
        return $this->model->find($code);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }


    public function update(array $data, $code)
    {
        return $this->model->find($code)->update($data);
    }

    public function delete($code)
    {
        return $this->model->find($code)->delete();
    }

    public function resolveModel()
    {
        return app($this->model);
    }
}

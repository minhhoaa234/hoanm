<?php

namespace App\Repositories;

class Repository implements RepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function paginate($quantity)
    {
        return $this->model->paginate($quantity);
    }

    public function persist($data)
    {
        return $this->model->insert($data);
    }
}
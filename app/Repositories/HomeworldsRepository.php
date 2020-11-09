<?php


namespace App\Repositories;

use App\Models\Homeworld as Model;

class HomeworldsRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        return $this->startConditions()->get();
    }

}

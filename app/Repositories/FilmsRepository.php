<?php


namespace App\Repositories;

use App\Models\Film as Model;

class FilmsRepository extends CoreRepository
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

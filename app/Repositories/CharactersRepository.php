<?php


namespace App\Repositories;

use App\Models\Character as Model;
use App\Models\Character;

class CharactersRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate($perPage)
    {
        return $this->startConditions()->orderBy('id','DESC')->
        with(['homeworld:id,name'])->
        with(['film:id,movieTitle'])->
        paginate($perPage);
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function createNew()
    {
        return new Character();
    }


}

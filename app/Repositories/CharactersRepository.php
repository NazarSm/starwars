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

    public function getAllWithPaginate(string $perPage)
    {
        return $this->startConditions()->orderBy('updated_at','DESC')
            ->with(['homeworld:id,name'])
            ->with('films')
            ->paginate($perPage);
    }

    public function getEdit(string $id)
    {
        return $this->startConditions()->find($id);
    }

    public function createNew()
    {
        return new Character();
    }


}

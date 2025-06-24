<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getForComboBox()
    {
        $columns = implode(', ', [
            'id',
            'title',
            'CONCAT(id, ". ", title) AS id_title',
        ]);

        return $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
    }

    public function getAllWithPaginate($perPage = null)
    {
        return $this
            ->startConditions()
            ->select(['id', 'title', 'parent_id'])
            ->paginate($perPage);
    }
}

<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllWithPaginate()
    {
        return $this->startConditions()
            ->select(['id', 'title', 'slug', 'is_published', 'published_at', 'user_id', 'category_id'])
            ->orderBy('id', 'DESC')
            ->paginate(25);
    }
}

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

    /**
     * Отримати модель для редагування
     *
     * @param int $id
     * @return Model|null
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Отримати список постів з підвантаженням зв’язків
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        return $this->startConditions()
            ->select(['id', 'title', 'slug', 'is_published', 'published_at', 'user_id', 'category_id'])
            ->with([
                'category:id,title',
                'user:id,name',
            ])
            ->orderBy('id', 'DESC')
            ->paginate(25);
    }
}

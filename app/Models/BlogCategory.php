<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * Батьківська категорія
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Назва батьківської категорії (accessor)
     */
    public function getParentTitleAttribute()
    {
        if ($this->parentCategory) {
            return $this->parentCategory->title;
        }

        return 'Без батьківської';
    }
}

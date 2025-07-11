<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    const UNKNOWN_USER = 1;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
        // 'user_id', ← прибрано
    ];

    /**
     * Категорія статті
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\BlogCategory::class);
    }

    /**
     * Автор статті
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

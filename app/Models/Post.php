<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'status',
        'published_at',
    ];

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_post'
        )->withTimestamps();
    }

    public function author()
    {
        return $this->belongsTo(
            Registration::class,
            'author_id'
        );
    }

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}

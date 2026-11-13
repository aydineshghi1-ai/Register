<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'created_by',
        'name',
        'slug',
        'description',
    ];

    public function creator()
    {
        return $this->belongsTo(Registration::class, 'created_by');
    }

    public function posts()
    {
        return $this->belongsToMany(
            Post::class,
            'category_post'
        )->withTimestamps();
    }
}

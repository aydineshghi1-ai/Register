<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function registrations()
    {
        return $this->belongsToMany(
            Registration::class,
            'registration_role'
        )->withTimestamps();
    }

    protected $fillable = [
        'name',
        'slug',
    ];
}

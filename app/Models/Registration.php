<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'birth_date',
        'national_id',
    ];
}

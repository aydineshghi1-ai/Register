<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Registration extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'birth_date',
        'national_id',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthPasswordName(): string
    {
        return 'password';
    }
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}

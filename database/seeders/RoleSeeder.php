<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Role::firstOrCreate(
            ['slug' => 'creator'],
            ['name' => 'creator']
        );

        Role::firstOrCreate(
            ['slug' => 'Admin'],
            ['name' => 'Admin']
        );

        Role::firstOrCreate(
            ['slug' => 'reporter'],
            ['name' => 'reporter']
        );
    }
}

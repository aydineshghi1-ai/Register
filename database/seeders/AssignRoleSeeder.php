<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Models\Role;
class AssignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registration = Registration::findOrFail(9);

        $roles = Role::whereIn('slug', [
            'admin',
            'reporter',
        ])->pluck('id');

        $registration->roles()->sync($roles);
    }
}

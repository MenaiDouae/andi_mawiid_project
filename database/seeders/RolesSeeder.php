<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $roles = ['Admin', 'Docteur', 'Assistant', 'Secrétaire', 'Patient'];
        foreach ($roles as $role){
            Role::firstOrCreate(['name' => $role]);
        }

    }
}

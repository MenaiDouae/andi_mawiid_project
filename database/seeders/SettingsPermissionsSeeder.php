<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SettingsPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Services
        $parent = Permission::create([
            'name' => 'Gestion des Services'
        ]);

        Permission::create([
            'name' => 'Consulter les services',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Consulter un service',
            'sub_permission' => $parent->id
        ]);
        
        Permission::create([
            'name' => 'Créer un nouveau service',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Modifier un service',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Supprimer un service',
            'sub_permission' => $parent->id
        ]);


    }
}

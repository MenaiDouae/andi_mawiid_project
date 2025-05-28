<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UsersPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Patients
        $parent = Permission::create([
            'name' => 'Gestion des patients'
        ]);

        Permission::create([
            'name' => 'Consulter un patient',
            'sub_permission' => $parent->id
        ]);
        
        Permission::create([
            'name' => 'Créer un nouveau patient',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Modifier un patient',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Supprimer un patient',
            'sub_permission' => $parent->id
        ]);

        // Personnels
        $parent = Permission::create([
            'name' => 'Gestion des personnels'
        ]);

        Permission::create([
            'name' => 'Consulter un personnel',
            'sub_permission' => $parent->id
        ]);
        
        Permission::create([
            'name' => 'Créer un nouveau personnel',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Modifier un personnel',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Supprimer un personnel',
            'sub_permission' => $parent->id
        ]);

        // Roles
        $parent = Permission::create([
            'name' => 'Gestion des Roles'
        ]);

        Permission::create([
            'name' => 'Consulter un role',
            'sub_permission' => $parent->id
        ]);
        
        Permission::create([
            'name' => 'Créer un nouveau role',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Modifier un role',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Supprimer un role',
            'sub_permission' => $parent->id
        ]);
    }
}

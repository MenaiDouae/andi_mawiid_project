<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RendezVousPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Services
        $parent = Permission::create([
            'name' => 'Gestion des Rendez-vous'
        ]);

        Permission::create([
            'name' => 'Consulter les Rendez-vous',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Consulter un rendez-vous',
            'sub_permission' => $parent->id
        ]);
        
        Permission::create([
            'name' => 'Créer un nouveau rendez-vous',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Modifier un rendez-vous',
            'sub_permission' => $parent->id
        ]);

        Permission::create([
            'name' => 'Supprimer un rendez-vous',
            'sub_permission' => $parent->id
        ]);
    }
}

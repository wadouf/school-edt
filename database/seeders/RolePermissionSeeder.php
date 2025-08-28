<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les rôles de base
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $chefRole = Role::firstOrCreate(['name' => 'chef']);
        $enseignantRole = Role::firstOrCreate(['name' => 'enseignant']);

        // Créer les permissions de base
        $permissions = [
            // Gestion des utilisateurs
            'manage_users',
            'create_users',
            'edit_users',
            'delete_users',
            
            // Gestion des classes
            'manage_classes',
            'create_classes',
            'edit_classes',
            'delete_classes',
            'view_classes',
            
            // Gestion des enseignants
            'manage_enseignants',
            'create_enseignants',
            'edit_enseignants',
            'delete_enseignants',
            'view_enseignants',
            
            // Gestion des matières
            'manage_matieres',
            'create_matieres',
            'edit_matieres',
            'delete_matieres',
            'view_matieres',
            
            // Gestion des salles
            'manage_salles',
            'create_salles',
            'edit_salles',
            'delete_salles',
            'view_salles',
            
            // Gestion des emplois du temps
            'manage_emplois',
            'create_emplois',
            'edit_emplois',
            'delete_emplois',
            'view_emplois',
            'generate_emplois',
            
            // Exports et rapports
            'export_pdf',
            'export_excel',
            'export_ical',
            'view_reports',
            
            // Disponibilités
            'manage_disponibilites',
            'edit_own_disponibilites',
            'view_disponibilites',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Attribuer toutes les permissions à l'admin
        $adminRole->syncPermissions(Permission::all());

        // Attribuer des permissions au chef d'établissement (presque tout sauf gestion users)
        $chefPermissions = Permission::whereNotIn('name', [
            'manage_users', 'create_users', 'edit_users', 'delete_users'
        ])->get();
        $chefRole->syncPermissions($chefPermissions);

        // Attribuer des permissions limitées à l'enseignant
        $enseignantPermissions = [
            'view_classes',
            'view_enseignants', 
            'view_matieres',
            'view_salles',
            'view_emplois',
            'edit_own_disponibilites',
            'view_disponibilites',
            'export_pdf',
            'export_ical',
        ];
        $enseignantRole->syncPermissions($enseignantPermissions);

        $this->command->info('Rôles et permissions créés avec succès!');
    }
}
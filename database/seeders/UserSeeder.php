<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Enseignant;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'utilisateur Admin principal
        $admin = User::firstOrCreate(
            ['email' => 'admin@ecole.fr'],
            [
                'name' => 'Administrateur',
                'email' => 'admin@ecole.fr',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Créer un utilisateur Chef d'établissement
        $chef = User::firstOrCreate(
            ['email' => 'chef@ecole.fr'],
            [
                'name' => 'Chef Établissement',
                'email' => 'chef@ecole.fr',
                'password' => Hash::make('chef123'),
                'email_verified_at' => now(),
            ]
        );
        $chef->assignRole('chef');

        // Créer quelques utilisateurs enseignants de test
        $enseignants_data = [
            [
                'user' => [
                    'name' => 'Jean Dupont',
                    'email' => 'j.dupont@ecole.fr',
                    'password' => Hash::make('password123'),
                ],
                'enseignant' => [
                    'nom' => 'Dupont',
                    'prenom' => 'Jean',
                    'email' => 'j.dupont@ecole.fr',
                    'type' => 'permanent',
                    'heures_max_semaine' => 18,
                    'matieres_enseignees' => [1, 2], // Sera mis à jour après création des matières
                    'sections_autorisees' => ['FR'],
                    'actif' => true,
                ]
            ],
            [
                'user' => [
                    'name' => 'Marie Martin',
                    'email' => 'm.martin@ecole.fr',
                    'password' => Hash::make('password123'),
                ],
                'enseignant' => [
                    'nom' => 'Martin',
                    'prenom' => 'Marie',
                    'email' => 'm.martin@ecole.fr',
                    'type' => 'permanent',
                    'heures_max_semaine' => 18,
                    'matieres_enseignees' => [3, 4],
                    'sections_autorisees' => ['FR', 'EN'],
                    'actif' => true,
                ]
            ],
            [
                'user' => [
                    'name' => 'John Smith',
                    'email' => 'j.smith@ecole.fr',
                    'password' => Hash::make('password123'),
                ],
                'enseignant' => [
                    'nom' => 'Smith',
                    'prenom' => 'John',
                    'email' => 'j.smith@ecole.fr',
                    'type' => 'vacataire',
                    'etablissement_attache' => 'Lycée International',
                    'heures_max_semaine' => 8,
                    'matieres_enseignees' => [5],
                    'sections_autorisees' => ['EN'],
                    'actif' => true,
                ]
            ],
        ];

        foreach ($enseignants_data as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['user']['email']],
                array_merge($data['user'], ['email_verified_at' => now()])
            );
            $user->assignRole('enseignant');

            // Créer le profil enseignant
            $enseignant_data = array_merge($data['enseignant'], ['user_id' => $user->id]);
            Enseignant::firstOrCreate(
                ['email' => $data['enseignant']['email']],
                $enseignant_data
            );
        }

        $this->command->info('Utilisateurs de test créés avec succès!');
        $this->command->info('Admin: admin@ecole.fr / admin123');
        $this->command->info('Chef: chef@ecole.fr / chef123');
        $this->command->info('Enseignants: *.@ecole.fr / password123');
    }
}
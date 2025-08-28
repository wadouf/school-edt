<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Niveau;
use App\Models\Filiere;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Salle;
use App\Models\CreneauHoraire;

class SchoolDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les sections linguistiques
        $sectionFr = Section::firstOrCreate([
            'nom' => 'Francophone',
            'code' => 'FR',
            'langue' => 'français',
            'description' => 'Section d\'enseignement en langue française',
            'actif' => true,
        ]);

        $sectionEn = Section::firstOrCreate([
            'nom' => 'Anglophone',
            'code' => 'EN',
            'langue' => 'anglais',
            'description' => 'Section d\'enseignement en langue anglaise',
            'actif' => true,
        ]);

        // Créer les filières
        $filieres = [
            // Filières francophones
            ['nom' => 'Scientifique', 'nom_en' => 'Science', 'code' => 'SCI', 'actif' => true],
            ['nom' => 'Littéraire', 'nom_en' => 'Literary', 'code' => 'LIT', 'actif' => true],
            ['nom' => 'Technique Commercial', 'nom_en' => 'Commercial Technical', 'code' => 'TC', 'actif' => true],
            ['nom' => 'Technique Industriel', 'nom_en' => 'Industrial Technical', 'code' => 'TI', 'actif' => true],
            // Filières anglophones
            ['nom' => 'Science', 'nom_en' => 'Science', 'code' => 'SCI_EN', 'actif' => true],
            ['nom' => 'Arts', 'nom_en' => 'Arts', 'code' => 'ART_EN', 'actif' => true],
        ];

        foreach ($filieres as $filiere) {
            Filiere::firstOrCreate(['code' => $filiere['code']], $filiere);
        }

        // Créer les niveaux
        $niveaux = [
            // Niveaux francophones (Collège)
            ['nom' => '6ème', 'nom_en' => 'Grade 6', 'code' => '6E', 'ordre' => 1, 'cycle' => 'Collège', 'actif' => true],
            ['nom' => '5ème', 'nom_en' => 'Grade 7', 'code' => '5E', 'ordre' => 2, 'cycle' => 'Collège', 'actif' => true],
            ['nom' => '4ème', 'nom_en' => 'Grade 8', 'code' => '4E', 'ordre' => 3, 'cycle' => 'Collège', 'actif' => true],
            ['nom' => '3ème', 'nom_en' => 'Grade 9', 'code' => '3E', 'ordre' => 4, 'cycle' => 'Collège', 'actif' => true],
            // Niveaux francophones (Lycée)
            ['nom' => 'Seconde', 'nom_en' => 'Grade 10', 'code' => '2ND', 'ordre' => 5, 'cycle' => 'Lycée', 'actif' => true],
            ['nom' => 'Première', 'nom_en' => 'Grade 11', 'code' => '1ER', 'ordre' => 6, 'cycle' => 'Lycée', 'actif' => true],
            ['nom' => 'Terminale', 'nom_en' => 'Grade 12', 'code' => 'TLE', 'ordre' => 7, 'cycle' => 'Lycée', 'actif' => true],
            // Niveaux anglophones
            ['nom' => 'Form 1', 'nom_en' => 'Form 1', 'code' => 'F1', 'ordre' => 1, 'cycle' => 'O-Levels', 'actif' => true],
            ['nom' => 'Form 2', 'nom_en' => 'Form 2', 'code' => 'F2', 'ordre' => 2, 'cycle' => 'O-Levels', 'actif' => true],
            ['nom' => 'Form 3', 'nom_en' => 'Form 3', 'code' => 'F3', 'ordre' => 3, 'cycle' => 'O-Levels', 'actif' => true],
            ['nom' => 'Form 4', 'nom_en' => 'Form 4', 'code' => 'F4', 'ordre' => 4, 'cycle' => 'O-Levels', 'actif' => true],
            ['nom' => 'Form 5', 'nom_en' => 'Form 5', 'code' => 'F5', 'ordre' => 5, 'cycle' => 'O-Levels', 'actif' => true],
            ['nom' => 'Lower Sixth', 'nom_en' => 'Lower Sixth', 'code' => 'L6', 'ordre' => 6, 'cycle' => 'A-Levels', 'actif' => true],
            ['nom' => 'Upper Sixth', 'nom_en' => 'Upper Sixth', 'code' => 'U6', 'ordre' => 7, 'cycle' => 'A-Levels', 'actif' => true],
        ];

        foreach ($niveaux as $niveau) {
            Niveau::firstOrCreate(['code' => $niveau['code']], $niveau);
        }

        // Créer les matières
        $matieres = [
            ['nom' => 'Mathématiques', 'nom_en' => 'Mathematics', 'code' => 'MATH', 'couleur' => '#007bff', 'tp_requis' => false],
            ['nom' => 'Français', 'nom_en' => 'French', 'code' => 'FR', 'couleur' => '#dc3545', 'tp_requis' => false],
            ['nom' => 'Anglais', 'nom_en' => 'English', 'code' => 'ANG', 'couleur' => '#28a745', 'tp_requis' => false],
            ['nom' => 'Histoire-Géographie', 'nom_en' => 'History-Geography', 'code' => 'HG', 'couleur' => '#ffc107', 'tp_requis' => false],
            ['nom' => 'Sciences Physiques', 'nom_en' => 'Physics', 'code' => 'PHYS', 'couleur' => '#17a2b8', 'tp_requis' => true, 'type_salle' => 'laboratoire'],
            ['nom' => 'Sciences de la Vie et de la Terre', 'nom_en' => 'Biology', 'code' => 'SVT', 'couleur' => '#20c997', 'tp_requis' => true, 'type_salle' => 'laboratoire'],
            ['nom' => 'Chimie', 'nom_en' => 'Chemistry', 'code' => 'CHIM', 'couleur' => '#6610f2', 'tp_requis' => true, 'type_salle' => 'laboratoire'],
            ['nom' => 'Informatique', 'nom_en' => 'Computer Science', 'code' => 'INFO', 'couleur' => '#6f42c1', 'tp_requis' => true, 'type_salle' => 'informatique'],
            ['nom' => 'Éducation Physique', 'nom_en' => 'Physical Education', 'code' => 'EPS', 'couleur' => '#fd7e14', 'tp_requis' => false, 'type_salle' => 'gymnase'],
            ['nom' => 'Économie', 'nom_en' => 'Economics', 'code' => 'ECO', 'couleur' => '#e83e8c', 'tp_requis' => false],
            ['nom' => 'Philosophie', 'nom_en' => 'Philosophy', 'code' => 'PHILO', 'couleur' => '#495057', 'tp_requis' => false],
            ['nom' => 'Arts Plastiques', 'nom_en' => 'Visual Arts', 'code' => 'ART', 'couleur' => '#f8f9fa', 'tp_requis' => false],
        ];

        foreach ($matieres as $matiere) {
            Matiere::firstOrCreate(['code' => $matiere['code']], $matiere);
        }

        // Créer les salles
        $salles = [
            // Salles normales
            ['nom' => 'Salle 101', 'code' => 'S101', 'type' => 'normale', 'capacite' => 40, 'localisation' => 'Bâtiment A - RDC'],
            ['nom' => 'Salle 102', 'code' => 'S102', 'type' => 'normale', 'capacite' => 40, 'localisation' => 'Bâtiment A - RDC'],
            ['nom' => 'Salle 201', 'code' => 'S201', 'type' => 'normale', 'capacite' => 35, 'localisation' => 'Bâtiment A - 1er étage'],
            ['nom' => 'Salle 202', 'code' => 'S202', 'type' => 'normale', 'capacite' => 35, 'localisation' => 'Bâtiment A - 1er étage'],
            // Laboratoires
            ['nom' => 'Laboratoire Physique', 'code' => 'LAB_PHYS', 'type' => 'laboratoire', 'capacite' => 24, 'localisation' => 'Bâtiment B - RDC'],
            ['nom' => 'Laboratoire Chimie', 'code' => 'LAB_CHIM', 'type' => 'laboratoire', 'capacite' => 24, 'localisation' => 'Bâtiment B - RDC'],
            ['nom' => 'Laboratoire SVT', 'code' => 'LAB_SVT', 'type' => 'laboratoire', 'capacite' => 20, 'localisation' => 'Bâtiment B - 1er étage'],
            // Salles spécialisées
            ['nom' => 'Salle Informatique 1', 'code' => 'INFO1', 'type' => 'informatique', 'capacite' => 30, 'localisation' => 'Bâtiment C - RDC'],
            ['nom' => 'Salle Informatique 2', 'code' => 'INFO2', 'type' => 'informatique', 'capacite' => 30, 'localisation' => 'Bâtiment C - RDC'],
            ['nom' => 'Gymnase', 'code' => 'GYM', 'type' => 'gymnase', 'capacite' => 60, 'localisation' => 'Bâtiment Sportif'],
        ];

        foreach ($salles as $salle) {
            Salle::firstOrCreate(['code' => $salle['code']], $salle);
        }

        // Créer les créneaux horaires (exemple : 7h30-16h00 avec pauses)
        $creneaux = [
            // Lundi
            ['jour_semaine' => 'lundi', 'heure_debut' => '07:30', 'heure_fin' => '08:25', 'ordre' => 1, 'nom' => '1ère heure'],
            ['jour_semaine' => 'lundi', 'heure_debut' => '08:30', 'heure_fin' => '09:25', 'ordre' => 2, 'nom' => '2ème heure'],
            ['jour_semaine' => 'lundi', 'heure_debut' => '09:25', 'heure_fin' => '09:40', 'ordre' => 3, 'nom' => 'Récréation', 'est_pause' => true],
            ['jour_semaine' => 'lundi', 'heure_debut' => '09:40', 'heure_fin' => '10:35', 'ordre' => 4, 'nom' => '3ème heure'],
            ['jour_semaine' => 'lundi', 'heure_debut' => '10:40', 'heure_fin' => '11:35', 'ordre' => 5, 'nom' => '4ème heure'],
            ['jour_semaine' => 'lundi', 'heure_debut' => '11:40', 'heure_fin' => '12:35', 'ordre' => 6, 'nom' => '5ème heure'],
            ['jour_semaine' => 'lundi', 'heure_debut' => '12:35', 'heure_fin' => '13:35', 'ordre' => 7, 'nom' => 'Pause déjeuner', 'est_pause' => true],
            ['jour_semaine' => 'lundi', 'heure_debut' => '13:35', 'heure_fin' => '14:30', 'ordre' => 8, 'nom' => '6ème heure'],
            ['jour_semaine' => 'lundi', 'heure_debut' => '14:35', 'heure_fin' => '15:30', 'ordre' => 9, 'nom' => '7ème heure'],
            ['jour_semaine' => 'lundi', 'heure_debut' => '15:35', 'heure_fin' => '16:30', 'ordre' => 10, 'nom' => '8ème heure'],
        ];

        // Répéter pour tous les jours de la semaine (sauf samedi pour l'instant)
        $jours = ['mardi', 'mercredi', 'jeudi', 'vendredi'];
        foreach ($jours as $jour) {
            foreach ($creneaux as $creneau) {
                $nouveau_creneau = $creneau;
                $nouveau_creneau['jour_semaine'] = $jour;
                CreneauHoraire::firstOrCreate([
                    'jour_semaine' => $jour,
                    'heure_debut' => $creneau['heure_debut']
                ], $nouveau_creneau);
            }
        }

        // Créer les créneaux pour lundi aussi
        foreach ($creneaux as $creneau) {
            CreneauHoraire::firstOrCreate([
                'jour_semaine' => 'lundi',
                'heure_debut' => $creneau['heure_debut']
            ], $creneau);
        }

        $this->command->info('Données scolaires de base créées avec succès!');
    }
}
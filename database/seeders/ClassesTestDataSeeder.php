<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Niveau;
use App\Models\Filiere;

class ClassesTestDataSeeder extends Seeder
{
    public function run(): void
    {
        Classe::create([
            'nom' => '6ème A Test',
            'code' => 'FR6EGENE',
            'section_id' => Section::where('nom', 'Francophone')->first()->id,
            'niveau_id' => Niveau::where('code', '6E')->first()->id,
            'filiere_id' => Filiere::where('code', 'SCI')->first()->id,
            'capacite_max' => 30,
            'salle_principale' => 'Salle A1',
            'actif' => true,
        ]);

        Classe::create([
            'nom' => '6ème A',
            'code' => 'FR6ESCI2',
            'section_id' => Section::where('nom', 'Francophone')->first()->id,
            'niveau_id' => Niveau::where('code', '6E')->first()->id,
            'filiere_id' => Filiere::where('code', 'SCI')->first()->id,
            'capacite_max' => 35,
            'salle_principale' => 'Salle A1',
            'actif' => true,
        ]);

        Classe::create([
            'nom' => '5ème B',
            'code' => 'AN5ELIT3',
            'section_id' => Section::where('nom', 'Anglophone')->first()->id,
            'niveau_id' => Niveau::where('code', '5E')->first()->id,
            'filiere_id' => Filiere::where('code', 'LIT')->first()->id,
            'capacite_max' => 32,
            'salle_principale' => 'Salle B2',
            'actif' => true,
        ]);

        Classe::create([
            'nom' => 'Form 1 Sciences',
            'code' => 'FR4ETC4',
            'section_id' => Section::where('nom', 'Francophone')->first()->id,
            'niveau_id' => Niveau::where('code', '4E')->first()->id,
            'filiere_id' => Filiere::where('code', 'TC')->first()->id,
            'capacite_max' => 28,
            'salle_principale' => 'Lab Sciences',
            'actif' => true,
        ]);

        Classe::create([
            'nom' => 'Form 2 Arts',
            'code' => 'AN3ESCI5',
            'section_id' => Section::where('nom', 'Anglophone')->first()->id,
            'niveau_id' => Niveau::where('code', '3E')->first()->id,
            'filiere_id' => Filiere::where('code', 'SCI')->first()->id,
            'capacite_max' => 30,
            'salle_principale' => 'Salle Arts',
            'actif' => true,
        ]);

        Classe::create([
            'nom' => '4ème C',
            'code' => 'FR2NDLIT6',
            'section_id' => Section::where('nom', 'Francophone')->first()->id,
            'niveau_id' => Niveau::where('code', '2ND')->first()->id,
            'filiere_id' => Filiere::where('code', 'LIT')->first()->id,
            'capacite_max' => 33,
            'salle_principale' => 'Salle C3',
            'actif' => true,
        ]);

        $this->command->info('Classes de test créées avec succès!');
    }
}

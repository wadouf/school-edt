<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classe;
use App\Models\Enseignant;
use App\Models\Matiere;
use App\Models\Salle;
use App\Models\EmploiDuTemps;
use App\Models\CreneauHoraire;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Statistiques générales
        $stats = [
            'classes' => Classe::count(),
            'enseignants' => Enseignant::count(),
            'matieres' => Matiere::count(),
            'salles' => Salle::count(),
            'emplois' => EmploiDuTemps::count(),
            'creneaux' => CreneauHoraire::count(),
        ];

        // Données spécifiques selon le rôle
        if ($user->hasRole('admin')) {
            return $this->adminDashboard($stats);
        } elseif ($user->hasRole('chef')) {
            return $this->chefDashboard($stats);
        } elseif ($user->hasRole('enseignant')) {
            return $this->enseignantDashboard($stats);
        }

        return view('dashboard', compact('stats'));
    }

    private function adminDashboard($stats)
    {
        // Données supplémentaires pour l'admin
        $recentActivities = \Spatie\Activitylog\Models\Activity::latest()
            ->limit(10)
            ->get();
        
        $users = User::with('roles')->latest()->limit(5)->get();
        
        return view('dashboards.admin', compact('stats', 'recentActivities', 'users'));
    }

    private function chefDashboard($stats)
    {
        // Données pour le chef d'établissement
        $classesCount = [
            'francophone' => Classe::whereHas('section', function($q) {
                $q->where('nom', 'Francophone');
            })->count(),
            'anglophone' => Classe::whereHas('section', function($q) {
                $q->where('nom', 'Anglophone');
            })->count(),
        ];

        $emploisDuTemps = EmploiDuTemps::with(['classe', 'enseignant', 'matiere', 'salle'])
            ->latest()
            ->limit(10)
            ->get();
        
        return view('dashboards.chef', compact('stats', 'classesCount', 'emploisDuTemps'));
    }

    private function enseignantDashboard($stats)
    {
        $user = auth()->user();
        $enseignant = $user->enseignant;
        
        if (!$enseignant) {
            return view('dashboard', compact('stats'));
        }

        // Emploi du temps de l'enseignant
        $mesEmplois = EmploiDuTemps::with(['classe', 'matiere', 'salle', 'creneauHoraire'])
            ->where('enseignant_id', $enseignant->id)
            ->orderBy('jour_semaine')
            ->orderBy('creneau_horaire_id')
            ->get();

        // Mes matières
        $mesMatieres = $enseignant->matieres;
        
        // Mes disponibilités
        $mesDisponibilites = $enseignant->disponibilites;
        
        return view('dashboards.enseignant', compact(
            'stats', 
            'enseignant', 
            'mesEmplois', 
            'mesMatieres', 
            'mesDisponibilites'
        ));
    }
}
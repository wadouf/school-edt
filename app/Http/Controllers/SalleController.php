<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SalleController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Salle::class);

        $query = Salle::query();

        // Filtres
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('disponible')) {
            $query->where('disponible', $request->disponible === '1');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('localisation', 'like', "%{$search}%");
            });
        }

        $salles = $query->orderBy('nom')->paginate(15)->appends($request->query());

        return view('salles.index', compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Salle::class);

        return view('salles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Salle::class);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:salles,code',
            'type' => 'required|in:normale,laboratoire,informatique,gymnase,autre',
            'capacite' => 'required|integer|min:1|max:200',
            'localisation' => 'nullable|string|max:255',
            'equipements' => 'nullable|array',
            'disponible' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $validated['disponible'] = $request->has('disponible');
        
        // Convertir les équipements en tableau ou null
        if (empty($validated['equipements'])) {
            $validated['equipements'] = null;
        }

        $salle = Salle::create($validated);

        return redirect()->route('salles.index')
            ->with('success', 'Salle créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salle $salle)
    {
        $this->authorize('view', $salle);

        // Charger les relations nécessaires
        $salle->load(['emploisDuTemps.classe', 'emploisDuTemps.matiere', 'emploisDuTemps.enseignant']);

        // Statistiques de la salle
        $stats = [
            'classes_utilisant' => $salle->emploisDuTemps->pluck('classe_id')->unique()->count(),
            'heures_semaine' => $salle->emploisDuTemps->count(),
            'matieres_enseignees' => $salle->emploisDuTemps->pluck('matiere_id')->unique()->count(),
            'enseignants_utilisant' => $salle->emploisDuTemps->pluck('enseignant_id')->unique()->count(),
        ];

        return view('salles.show', compact('salle', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salle $salle)
    {
        $this->authorize('update', $salle);

        return view('salles.edit', compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salle $salle)
    {
        $this->authorize('update', $salle);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:salles,code,' . $salle->id,
            'type' => 'required|in:normale,laboratoire,informatique,gymnase,autre',
            'capacite' => 'required|integer|min:1|max:200',
            'localisation' => 'nullable|string|max:255',
            'equipements' => 'nullable|array',
            'disponible' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $validated['disponible'] = $request->has('disponible');
        
        // Convertir les équipements en tableau ou null
        if (empty($validated['equipements'])) {
            $validated['equipements'] = null;
        }

        $salle->update($validated);

        return redirect()->route('salles.index')
            ->with('success', 'Salle mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salle $salle)
    {
        $this->authorize('delete', $salle);

        // Vérifier s'il y a des emplois du temps ou des classes liés
        if ($salle->emploisDuTemps()->count() > 0) {
            return redirect()->route('salles.index')
                ->with('error', 'Impossible de supprimer cette salle car elle a des emplois du temps associés.');
        }

        // Vérifier s'il y a des classes qui utilisent cette salle comme salle principale
        $classesUtilisant = \App\Models\Classe::where('salle_principale_id', $salle->id)->count();
        if ($classesUtilisant > 0) {
            return redirect()->route('salles.index')
                ->with('error', 'Impossible de supprimer cette salle car ' . $classesUtilisant . ' classe(s) l\'utilisent comme salle principale.');
        }

        $salle->delete();

        return redirect()->route('salles.index')
            ->with('success', 'Salle supprimée avec succès.');
    }

    /**
     * Export des salles
     */
    public function export(Request $request)
    {
        $this->authorize('viewAny', Salle::class);

        $format = $request->get('format', 'csv');
        
        if ($format === 'csv') {
            return $this->exportCsv();
        }
        
        return redirect()->back()->with('error', 'Format d\'export non supporté');
    }

    /**
     * Export CSV
     */
    private function exportCsv()
    {
        $salles = Salle::orderBy('nom')->get();

        $filename = 'salles_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        return response()->stream(function () use ($salles) {
            $handle = fopen('php://output', 'w');
            
            // Headers
            fputcsv($handle, [
                'ID',
                'Nom',
                'Code',
                'Type',
                'Capacité',
                'Localisation',
                'Équipements',
                'Disponible',
                'Notes',
                'Créé le'
            ]);

            // Data
            foreach ($salles as $salle) {
                fputcsv($handle, [
                    $salle->id,
                    $salle->nom,
                    $salle->code,
                    $salle->type,
                    $salle->capacite,
                    $salle->localisation,
                    $salle->equipements ? implode(', ', $salle->equipements) : '',
                    $salle->disponible ? 'Oui' : 'Non',
                    $salle->notes,
                    $salle->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
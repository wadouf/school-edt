<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Section;
use App\Models\Niveau;
use App\Models\Filiere;
use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClasseController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Classe::class);

        $query = Classe::with(['section', 'niveau', 'filiere']);

        // Filtres
        if ($request->filled('section_id')) {
            $query->where('section_id', $request->section_id);
        }

        if ($request->filled('niveau_id')) {
            $query->where('niveau_id', $request->niveau_id);
        }

        if ($request->filled('filiere_id')) {
            $query->where('filiere_id', $request->filiere_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $classes = $query->paginate(15)->appends($request->query());
        
        $sections = Section::all();
        $niveaux = Niveau::all();
        $filieres = Filiere::all();

        return view('classes.index', compact('classes', 'sections', 'niveaux', 'filieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Classe::class);

        $sections = Section::all();
        $niveaux = Niveau::all();
        $filieres = Filiere::all();
        $salles = Salle::disponible()->orderBy('nom')->get();

        return view('classes.create', compact('sections', 'niveaux', 'filieres', 'salles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Classe::class);

        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'filiere_id' => 'required|exists:filieres,id',
            'nom' => 'required|string|max:255',
            'code' => 'nullable|string|max:10|unique:classes,code',
            'capacite_max' => 'nullable|integer|min:1|max:50',
            'salle_principale_id' => 'nullable|exists:salles,id',
            'actif' => 'boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        // Générer automatiquement le code si non fourni
        if (empty($validated['code'])) {
            $validated['code'] = $this->generateClasseCode($validated);
        }

        $classe = Classe::create($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Classe créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        $this->authorize('view', $classe);

        $classe->load(['section', 'niveau', 'filiere', 'emploisDuTemps.matiere', 'emploisDuTemps.enseignant']);

        // Statistiques de la classe
        $stats = [
            'emplois_count' => $classe->emploisDuTemps->count(),
            'heures_semaine' => $classe->emploisDuTemps->count(), // Simplified
            'matieres_count' => $classe->emploisDuTemps->pluck('matiere_id')->unique()->count(),
            'enseignants_count' => $classe->emploisDuTemps->pluck('enseignant_id')->unique()->count(),
        ];

        return view('classes.show', compact('classe', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        $this->authorize('update', $classe);

        $sections = Section::all();
        $niveaux = Niveau::all();
        $filieres = Filiere::all();
        $salles = Salle::disponible()->orderBy('nom')->get();

        return view('classes.edit', compact('classe', 'sections', 'niveaux', 'filieres', 'salles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $classe)
    {
        $this->authorize('update', $classe);

        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'filiere_id' => 'required|exists:filieres,id',
            'nom' => 'required|string|max:255',
            'code' => 'nullable|string|max:10|unique:classes,code,' . $classe->id,
            'capacite_max' => 'nullable|integer|min:1|max:50',
            'salle_principale_id' => 'nullable|exists:salles,id',
            'actif' => 'boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        // Régénérer le code si les données de base ont changé
        if (empty($validated['code']) || 
            $classe->section_id != $validated['section_id'] ||
            $classe->niveau_id != $validated['niveau_id'] ||
            $classe->filiere_id != $validated['filiere_id']) {
            $validated['code'] = $this->generateClasseCode($validated, $classe->id);
        }

        $classe->update($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Classe mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        $this->authorize('delete', $classe);

        // Vérifier s'il y a des emplois du temps liés
        if ($classe->emploisDuTemps()->count() > 0) {
            return redirect()->route('classes.index')
                ->with('error', 'Impossible de supprimer cette classe car elle a des emplois du temps associés.');
        }

        $classe->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Classe supprimée avec succès.');
    }

    /**
     * Générer un code unique pour la classe
     */
    private function generateClasseCode(array $data, $excludeId = null)
    {
        $section = Section::find($data['section_id']);
        $niveau = Niveau::find($data['niveau_id']);
        $filiere = Filiere::find($data['filiere_id']);

        $sectionCode = $section ? strtoupper(substr($section->nom, 0, 2)) : 'XX';
        $niveauCode = $niveau ? str_replace(' ', '', $niveau->code) : '00';
        $filiereCode = $filiere ? strtoupper(substr($filiere->code, 0, 3)) : 'XXX';

        $baseCode = $sectionCode . $niveauCode . $filiereCode;
        
        // Vérifier l'unicité
        $counter = 1;
        $finalCode = $baseCode;
        
        $query = Classe::where('code', $finalCode);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        while ($query->exists()) {
            $finalCode = $baseCode . $counter;
            $counter++;
            
            $query = Classe::where('code', $finalCode);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $finalCode;
    }

    /**
     * Export des classes
     */
    public function export(Request $request)
    {
        $this->authorize('viewAny', Classe::class);

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
        $classes = Classe::with(['section', 'niveau', 'filiere'])->get();

        $filename = 'classes_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        return response()->stream(function () use ($classes) {
            $handle = fopen('php://output', 'w');
            
            // Headers
            fputcsv($handle, [
                'ID',
                'Nom',
                'Code',
                'Section',
                'Niveau',
                'Filière',
                'Capacité Max',
                'Salle Principale',
                'Actif',
                'Créé le'
            ]);

            // Data
            foreach ($classes as $classe) {
                fputcsv($handle, [
                    $classe->id,
                    $classe->nom,
                    $classe->code,
                    $classe->section->nom ?? '',
                    $classe->niveau->nom ?? '',
                    $classe->filiere->nom ?? '',
                    $classe->capacite_max,
                    $classe->salle_principale,
                    $classe->actif ? 'Oui' : 'Non',
                    $classe->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
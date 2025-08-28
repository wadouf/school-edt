<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                <i class="fas fa-school text-primary me-2"></i> 
                Gestion des Classes
            </h2>
            @can('create', App\Models\Classe::class)
                <a href="{{ route('classes.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Nouvelle Classe
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filtres et Recherche -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light border-0">
                <h6 class="card-title fw-semibold mb-0">
                    <i class="fas fa-filter text-primary me-2"></i>
                    Filtres et Recherche
                </h6>
            </div>
            <form method="GET" action="{{ route('classes.index') }}" class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="search" class="form-label fw-semibold">Recherche</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   id="search"
                                   value="{{ request('search') }}"
                                   placeholder="Nom ou code..."
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="section_id" class="form-label fw-semibold">Section</label>
                        <select name="section_id" id="section_id" class="form-select">
                            <option value="">Toutes</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="niveau_id" class="form-label fw-semibold">Niveau</label>
                        <select name="niveau_id" id="niveau_id" class="form-select">
                            <option value="">Tous</option>
                            @foreach($niveaux as $niveau)
                                <option value="{{ $niveau->id }}" {{ request('niveau_id') == $niveau->id ? 'selected' : '' }}>
                                    {{ $niveau->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="filiere_id" class="form-label fw-semibold">Filière</label>
                        <select name="filiere_id" id="filiere_id" class="form-select">
                            <option value="">Toutes</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ request('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                    {{ $filiere->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-lg-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-search me-1"></i> Filtrer
                            </button>
                            <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Actions en lot -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold text-dark mb-1">
                            <i class="fas fa-list text-primary me-2"></i>
                            {{ $classes->total() }} classe(s) trouvée(s)
                        </h6>
                        <small class="text-muted">Gérer et organiser les classes de l'établissement</small>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('classes.export', ['format' => 'csv'] + request()->query()) }}" 
                           class="btn btn-outline-success">
                            <i class="fas fa-file-csv me-2"></i> Export CSV
                        </a>
                        @can('create', App\Models\Classe::class)
                            <a href="{{ route('classes.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Nouvelle Classe
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des Classes -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-semibold">Code</th>
                                <th class="fw-semibold">Nom</th>
                                <th class="fw-semibold">Section</th>
                                <th class="fw-semibold">Niveau</th>
                                <th class="fw-semibold">Filière</th>
                                <th class="fw-semibold">Effectif</th>
                                <th class="fw-semibold">Statut</th>
                                <th class="fw-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classes as $classe)
                                <tr>
                                    <td>
                                        <code class="bg-light px-2 py-1 rounded fw-bold text-primary">
                                            {{ $classe->code }}
                                        </code>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $classe->nom }}</div>
                                        @if($classe->salle_attitre)
                                            <small class="text-muted">
                                                <i class="fas fa-door-open me-1"></i>{{ $classe->salle_attitre }}
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $classe->section->nom === 'Francophone' ? 'bg-primary' : 'bg-danger' }} rounded-pill">
                                            <i class="fas fa-flag me-1"></i>
                                            {{ $classe->section->nom ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-medium">{{ $classe->niveau->nom ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $classe->filiere->nom ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        @if($classe->effectif_max)
                                            <span class="badge bg-info rounded-pill">
                                                <i class="fas fa-users me-1"></i>{{ $classe->effectif_max }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($classe->actif)
                                            <span class="badge bg-success rounded-pill">
                                                <i class="fas fa-check-circle me-1"></i>Actif
                                            </span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill">
                                                <i class="fas fa-pause-circle me-1"></i>Inactif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            @can('view', $classe)
                                                <a href="{{ route('classes.show', $classe) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Voir les détails">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('update', $classe)
                                                <a href="{{ route('classes.edit', $classe) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete', $classe)
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="Supprimer"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal{{ $classe->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <!-- Modal de confirmation -->
                                                <div class="modal fade" id="deleteModal{{ $classe->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirmer la Suppression</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Êtes-vous sûr de vouloir supprimer la classe <strong>{{ $classe->nom }}</strong> ?</p>
                                                                <p class="text-muted small">Cette action est irréversible.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <form action="{{ route('classes.destroy', $classe) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fas fa-trash me-2"></i>Supprimer
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-school fs-1 mb-3 d-block"></i>
                                            <h6>Aucune classe trouvée</h6>
                                            @if(request()->hasAny(['search', 'section_id', 'niveau_id', 'filiere_id']))
                                                <p class="small mb-3">Aucune classe ne correspond aux critères de recherche</p>
                                                <a href="{{ route('classes.index') }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-list me-2"></i>Voir toutes les classes
                                                </a>
                                            @else
                                                <p class="small mb-3">Commencez par créer votre première classe</p>
                                                @can('create', App\Models\Classe::class)
                                                    <a href="{{ route('classes.create') }}" class="btn btn-primary">
                                                        <i class="fas fa-plus me-2"></i>Créer une classe
                                                    </a>
                                                @endcan
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($classes->hasPages())
                    <div class="card-footer bg-light border-0">
                        {{ $classes->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
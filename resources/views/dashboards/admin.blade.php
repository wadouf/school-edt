<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                <i class="fas fa-user-cog text-primary me-2"></i> 
                Tableau de Bord - Administrateur
            </h2>
            <div class="d-flex gap-2">
                <span class="badge bg-success px-3 py-2">
                    <i class="fas fa-circle me-1" style="font-size: 0.6em;"></i>
                    Système Actif
                </span>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid py-4">
        <!-- Statistiques générales -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6 col-xl-2">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-school text-primary fs-4"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-primary mb-1">{{ $stats['classes'] }}</h3>
                        <p class="text-muted small mb-0">Classes</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-2">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-chalkboard-teacher text-success fs-4"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-success mb-1">{{ $stats['enseignants'] }}</h3>
                        <p class="text-muted small mb-0">Enseignants</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-2">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-book text-info fs-4"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-info mb-1">{{ $stats['matieres'] }}</h3>
                        <p class="text-muted small mb-0">Matières</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-2">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-door-open text-warning fs-4"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-warning mb-1">{{ $stats['salles'] }}</h3>
                        <p class="text-muted small mb-0">Salles</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-2">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-calendar-alt text-danger fs-4"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-danger mb-1">{{ $stats['emplois'] }}</h3>
                        <p class="text-muted small mb-0">Emplois</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-2">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="bg-secondary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-clock text-secondary fs-4"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-secondary mb-1">{{ $stats['creneaux'] }}</h3>
                        <p class="text-muted small mb-0">Créneaux</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Gestion Rapide -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-tools text-primary me-2"></i>
                            Gestion Rapide
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <a href="#" class="btn btn-outline-primary w-100 py-3">
                                    <i class="fas fa-users fs-5 d-block mb-2"></i>
                                    <span class="fw-semibold">Utilisateurs</span>
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{ route('classes.index') }}" class="btn btn-outline-success w-100 py-3">
                                    <i class="fas fa-school fs-5 d-block mb-2"></i>
                                    <span class="fw-semibold">Classes</span>
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="#" class="btn btn-outline-warning w-100 py-3">
                                    <i class="fas fa-chalkboard-teacher fs-5 d-block mb-2"></i>
                                    <span class="fw-semibold">Enseignants</span>
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="#" class="btn btn-outline-info w-100 py-3">
                                    <i class="fas fa-book fs-5 d-block mb-2"></i>
                                    <span class="fw-semibold">Matières</span>
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="#" class="btn btn-outline-dark w-100 py-3">
                                    <i class="fas fa-door-open fs-5 d-block mb-2"></i>
                                    <span class="fw-semibold">Salles</span>
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="#" class="btn btn-outline-secondary w-100 py-3">
                                    <i class="fas fa-calendar-alt fs-5 d-block mb-2"></i>
                                    <span class="fw-semibold">Emplois du Temps</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activités Récentes -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-history text-primary me-2"></i>
                            Activités Récentes
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="activity-feed" style="max-height: 300px; overflow-y: auto;">
                            @forelse($recentActivities as $activity)
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle p-2" style="width: 32px; height: 32px;">
                                            <div class="bg-white rounded-circle mx-auto" style="width: 4px; height: 4px;"></div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-1 small">{{ $activity->description }}</p>
                                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="fas fa-history text-muted fs-1 mb-3"></i>
                                    <p class="text-muted">Aucune activité récente</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Utilisateurs Récents -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-user-plus text-primary me-2"></i>
                            Utilisateurs Récents
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-semibold">Nom</th>
                                        <th class="fw-semibold">Email</th>
                                        <th class="fw-semibold">Rôle</th>
                                        <th class="fw-semibold">Créé le</th>
                                        <th class="fw-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                                    </div>
                                                    <span class="fw-semibold">{{ $user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="text-muted">{{ $user->email }}</td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                    <span class="badge bg-primary rounded-pill">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td class="text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                <i class="fas fa-users fs-1 mb-3 d-block"></i>
                                                Aucun utilisateur
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
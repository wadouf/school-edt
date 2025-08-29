<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institut Polyvalent Bilingue Les Pintades - Gestion des Salles</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --sidebar-width: 280px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #334155 100%);
            color: white;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .logo img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(2px);
        }

        .nav-link.active {
            background: var(--primary-color);
            color: white;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .content-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.5rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .content-body {
            padding: 2rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .page-subtitle {
            color: #64748b;
            margin-top: 0.5rem;
            font-size: 0.95rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-outline-secondary {
            border: 1px solid #d1d5db;
            color: #64748b;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Table Styles */
        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 600;
            color: #374151;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            padding: 0.75rem;
        }

        .table td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border-bottom: 1px solid #e2e8f0;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .badge-danger {
            background-color: #fecaca;
            color: #dc2626;
        }

        .badge-warning {
            background-color: #fef3c7;
            color: #d97706;
        }

        .badge-info {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .badge-secondary {
            background-color: #f1f5f9;
            color: #64748b;
        }

        /* Form Styles */
        .form-control, .form-select {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.25rem;
        }

        /* Pagination */
        .pagination {
            margin: 0;
        }

        .page-link {
            border: 1px solid #d1d5db;
            color: #64748b;
            padding: 0.5rem 0.75rem;
        }

        .page-link:hover {
            background-color: #f8fafc;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Stats Cards */
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--primary-color);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .stats-label {
            color: #64748b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .content-body {
                padding: 1rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-graduation-cap" style="color: white; font-size: 1.2rem;"></i>
                </div>
                <div>
                    <div class="logo-text">Les Pintades</div>
                    <div style="font-size: 0.75rem; color: rgba(255, 255, 255, 0.7);">Institut Bilingue</div>
                </div>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Tableau de bord</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('classes.index') }}" class="nav-link">
                    <i class="fas fa-chalkboard"></i>
                    <span>Classes</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('salles.index') }}" class="nav-link active">
                    <i class="fas fa-door-open"></i>
                    <span>Salles</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-tie"></i>
                    <span>Enseignants</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-book"></i>
                    <span>Matières</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Emplois du temps</span>
                </a>
            </div>
            
            <hr style="margin: 1rem; border-color: rgba(255, 255, 255, 0.1);">
            
            <div class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link" style="border: none; background: none; width: 100%; text-align: left;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Gestion des Salles</h1>
                    <p class="page-subtitle">Gérez les salles de classe et leurs équipements</p>
                </div>
                <div>
                    @can('create', App\Models\Salle::class)
                        <a href="{{ route('salles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Nouvelle Salle
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Content Body -->
        <div class="content-body">
            <!-- Messages d'alerte -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $salles->total() }}</div>
                        <div class="stats-label">Total des salles</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="border-left-color: var(--success-color);">
                        <div class="stats-number" style="color: var(--success-color);">
                            {{ $salles->where('disponible', true)->count() }}
                        </div>
                        <div class="stats-label">Salles disponibles</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="border-left-color: var(--warning-color);">
                        <div class="stats-number" style="color: var(--warning-color);">
                            {{ $salles->where('type', 'laboratoire')->count() }}
                        </div>
                        <div class="stats-label">Laboratoires</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="border-left-color: var(--danger-color);">
                        <div class="stats-number" style="color: var(--danger-color);">
                            {{ $salles->where('type', 'informatique')->count() }}
                        </div>
                        <div class="stats-label">Salles informatiques</div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-filter me-2"></i>
                        Filtres et Recherche
                    </h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('salles.index') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Rechercher</label>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Nom, code ou localisation..." 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Type de salle</label>
                                <select name="type" class="form-select">
                                    <option value="">Tous les types</option>
                                    <option value="normale" {{ request('type') === 'normale' ? 'selected' : '' }}>Normale</option>
                                    <option value="laboratoire" {{ request('type') === 'laboratoire' ? 'selected' : '' }}>Laboratoire</option>
                                    <option value="informatique" {{ request('type') === 'informatique' ? 'selected' : '' }}>Informatique</option>
                                    <option value="gymnase" {{ request('type') === 'gymnase' ? 'selected' : '' }}>Gymnase</option>
                                    <option value="autre" {{ request('type') === 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Disponibilité</label>
                                <select name="disponible" class="form-select">
                                    <option value="">Toutes</option>
                                    <option value="1" {{ request('disponible') === '1' ? 'selected' : '' }}>Disponibles</option>
                                    <option value="0" {{ request('disponible') === '0' ? 'selected' : '' }}>Non disponibles</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="{{ route('salles.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        <i class="fas fa-door-open me-2"></i>
                        Liste des Salles
                    </h5>
                    <div>
                        @can('viewAny', App\Models\Salle::class)
                            <a href="{{ route('salles.export', ['format' => 'csv']) }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-download me-1"></i>
                                Exporter CSV
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Capacité</th>
                                    <th>Localisation</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($salles as $salle)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $salle->nom }}</div>
                                            @if($salle->equipements)
                                                <small class="text-muted">
                                                    <i class="fas fa-cogs me-1"></i>
                                                    {{ count($salle->equipements) }} équipement(s)
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary">{{ $salle->code }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $typeColors = [
                                                    'normale' => 'info',
                                                    'laboratoire' => 'warning',
                                                    'informatique' => 'success',
                                                    'gymnase' => 'danger',
                                                    'autre' => 'secondary'
                                                ];
                                                $color = $typeColors[$salle->type] ?? 'secondary';
                                            @endphp
                                            <span class="badge badge-{{ $color }}">
                                                {{ ucfirst($salle->type) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $salle->capacite }}</span>
                                            <small class="text-muted">pers.</small>
                                        </td>
                                        <td>
                                            <div>{{ $salle->localisation ?: '-' }}</div>
                                        </td>
                                        <td>
                                            @if($salle->disponible)
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check me-1"></i>Disponible
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times me-1"></i>Indisponible
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                @can('view', $salle)
                                                    <a href="{{ route('salles.show', $salle) }}" 
                                                       class="btn btn-sm btn-outline-secondary" title="Voir les détails">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                                
                                                @can('update', $salle)
                                                    <a href="{{ route('salles.edit', $salle) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                                
                                                @can('delete', $salle)
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger delete-btn" 
                                                            title="Supprimer"
                                                            data-salle-id="{{ $salle->id }}"
                                                            data-salle-nom="{{ $salle->nom }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-door-open fa-3x mb-3" style="opacity: 0.3;"></i>
                                                <div>Aucune salle trouvée</div>
                                                @can('create', App\Models\Salle::class)
                                                    <a href="{{ route('salles.create') }}" class="btn btn-primary btn-sm mt-2">
                                                        <i class="fas fa-plus me-1"></i>
                                                        Créer la première salle
                                                    </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($salles->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Affichage de {{ $salles->firstItem() }} à {{ $salles->lastItem() }} 
                                sur {{ $salles->total() }} résultats
                            </div>
                            {{ $salles->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                        Confirmer la suppression
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer la salle <strong id="salle-nom"></strong> ?</p>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Cette action est irréversible !
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form id="delete-form" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion de la suppression optimisée avec modal unique
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('delete-form');
            const salleNomElement = document.getElementById('salle-nom');

            // Délégation d'événements pour tous les boutons de suppression
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-btn')) {
                    const btn = e.target.closest('.delete-btn');
                    const salleId = btn.dataset.salleId;
                    const salleNom = btn.dataset.salleNom;
                    
                    // Mise à jour du contenu du modal
                    salleNomElement.textContent = salleNom;
                    deleteForm.action = `/salles/${salleId}`;
                    
                    // Affichage du modal
                    deleteModal.show();
                }
            });

            // Auto-masquer les alertes après 5 secondes
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Gestion des Classes</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">

        <!-- Custom Styles -->
        <style>
            :root {
                --primary-color: #2563eb;
                --sidebar-width: 280px;
                --sidebar-collapsed-width: 80px;
                --header-height: 70px;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                background-color: #f8fafc;
                color: #334155;
                overflow-x: hidden;
            }

            /* Sidebar Styles */
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: var(--sidebar-width);
                background: linear-gradient(180deg, #1e293b 0%, #334155 100%);
                transition: all 0.3s ease;
                z-index: 1000;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .sidebar.collapsed {
                width: var(--sidebar-collapsed-width);
            }

            .sidebar-header {
                padding: 1.5rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .sidebar-logo {
                display: flex;
                align-items: center;
                color: white;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .sidebar-logo .logo-icon {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.2rem;
                margin-right: 0.75rem;
                flex-shrink: 0;
            }

            .sidebar-logo .logo-text h6 {
                margin: 0;
                font-weight: 700;
                font-size: 1.1rem;
                line-height: 1.2;
            }

            .sidebar-logo .logo-text small {
                font-size: 0.75rem;
                opacity: 0.8;
            }

            .sidebar.collapsed .logo-text {
                opacity: 0;
                width: 0;
                overflow: hidden;
            }

            .sidebar-toggle {
                background: none;
                border: none;
                color: white;
                font-size: 1rem;
                cursor: pointer;
                padding: 0.5rem;
                border-radius: 0.25rem;
                transition: all 0.2s ease;
            }

            .sidebar-toggle:hover {
                background-color: rgba(255, 255, 255, 0.1);
            }

            /* Navigation */
            .sidebar-nav {
                padding: 1rem 0;
                height: calc(100vh - 90px);
                overflow-y: auto;
            }

            .nav-item {
                margin: 0 0.75rem 0.25rem;
            }

            .nav-link {
                display: flex;
                align-items: center;
                padding: 0.875rem 1rem;
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                border-radius: 0.5rem;
                transition: all 0.2s ease;
                font-weight: 500;
            }

            .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.1);
                color: white;
                transform: translateX(4px);
            }

            .nav-link.active {
                background-color: var(--primary-color);
                color: white;
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
            }

            .nav-link i {
                width: 20px;
                font-size: 1.1rem;
                margin-right: 0.875rem;
                text-align: center;
                flex-shrink: 0;
            }

            .nav-link .nav-text {
                transition: all 0.3s ease;
            }

            .sidebar.collapsed .nav-text {
                opacity: 0;
                width: 0;
                overflow: hidden;
            }

            .nav-section {
                padding: 0 1.5rem;
                margin: 1.5rem 0 0.5rem;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: rgba(255, 255, 255, 0.5);
            }

            .sidebar.collapsed .nav-section {
                opacity: 0;
                height: 0;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }

            /* Main Content */
            .main-wrapper {
                margin-left: var(--sidebar-width);
                transition: all 0.3s ease;
                min-height: 100vh;
            }

            .main-wrapper.sidebar-collapsed {
                margin-left: var(--sidebar-collapsed-width);
            }

            .top-header {
                background: white;
                padding: 1rem 2rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                position: sticky;
                top: 0;
                z-index: 999;
                display: flex;
                justify-content: space-between;
                align-items: center;
                min-height: var(--header-height);
            }

            .user-menu {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.5rem 1rem;
                border: 1px solid #e2e8f0;
                border-radius: 0.5rem;
                background: white;
                transition: all 0.2s ease;
                cursor: pointer;
                text-decoration: none;
                color: inherit;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
                background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: 600;
                font-size: 0.9rem;
            }

            .main-content {
                padding: 2rem;
                min-height: calc(100vh - var(--header-height));
            }

            /* Responsive */
            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                }

                .sidebar.show {
                    transform: translateX(0);
                }

                .main-wrapper {
                    margin-left: 0;
                }

                .main-wrapper.sidebar-collapsed {
                    margin-left: 0;
                }
            }

            /* Cards and components */
            .card {
                border: none;
                border-radius: 0.75rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                transition: all 0.2s ease;
            }

            .card:hover {
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                transform: translateY(-2px);
            }
        </style>
    </head>
    <body>
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="sidebar-logo">
                    <div class="logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="logo-text">
                        <h6>Institut Les Pintades</h6>
                        <small>Gestion EDT</small>
                    </div>
                </a>
                <button class="sidebar-toggle d-none d-md-block" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Tableau de Bord</span>
                    </a>
                </div>

                <div class="nav-section">Gestion</div>
                
                @can('viewAny', App\Models\Classe::class)
                <div class="nav-item">
                    <a href="{{ route('classes.index') }}" class="nav-link active">
                        <i class="fas fa-school"></i>
                        <span class="nav-text">Classes</span>
                    </a>
                </div>
                @endcan

                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span class="nav-text">Enseignants</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span class="nav-text">Matières</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-door-open"></i>
                        <span class="nav-text">Salles</span>
                    </a>
                </div>

                <div class="nav-section">Emplois du Temps</div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="nav-text">Planning</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-clock"></i>
                        <span class="nav-text">Créneaux Horaires</span>
                    </a>
                </div>

                @hasrole('admin')
                <div class="nav-section">Administration</div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Utilisateurs</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span class="nav-text">Paramètres</span>
                    </a>
                </div>
                @endhasrole
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-wrapper" id="mainWrapper">
            <!-- Top Header -->
            <header class="top-header">
                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary d-md-none me-3" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="d-flex justify-content-between align-items-center w-100">
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
                </div>

                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-success">
                        <i class="fas fa-circle me-1" style="font-size: 0.6em;"></i>
                        En ligne
                    </span>

                    <div class="dropdown">
                        <a href="#" class="user-menu" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="d-none d-sm-block">
                                <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                <small class="text-muted">
                                    @foreach(Auth::user()->roles as $role)
                                        {{ ucfirst($role->name) }}
                                    @endforeach
                                </small>
                            </div>
                            <i class="fas fa-chevron-down ms-2"></i>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user me-2"></i> Mon Profil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="main-content">
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
            </main>
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Sidebar Toggle Script -->
        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const mainWrapper = document.getElementById('mainWrapper');
                
                if (window.innerWidth <= 768) {
                    // Mobile behavior
                    sidebar.classList.toggle('show');
                } else {
                    // Desktop behavior
                    sidebar.classList.toggle('collapsed');
                    mainWrapper.classList.toggle('sidebar-collapsed');
                }
            }

            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    const sidebar = document.getElementById('sidebar');
                    const toggleBtn = document.querySelector('.d-md-none');
                    
                    if (!sidebar.contains(event.target) && !toggleBtn?.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                const sidebar = document.getElementById('sidebar');
                
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                }
            });
        </script>
    </body>
</html>
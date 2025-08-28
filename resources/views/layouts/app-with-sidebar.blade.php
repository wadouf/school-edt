<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
                --secondary-color: #64748b;
                --success-color: #10b981;
                --danger-color: #ef4444;
                --warning-color: #f59e0b;
                --info-color: #06b6d4;
                --light-color: #f8fafc;
                --dark-color: #1e293b;
                --sidebar-width: 280px;
                --sidebar-collapsed-width: 80px;
                --header-height: 70px;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                background-color: #f8fafc;
                color: #334155;
                line-height: 1.6;
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

            .sidebar-logo .logo-text {
                transition: all 0.3s ease;
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

            /* Navigation Styles */
            .sidebar-nav {
                padding: 1rem 0;
                height: calc(100vh - var(--header-height) - 2rem);
                overflow-y: auto;
            }

            .sidebar-nav::-webkit-scrollbar {
                width: 4px;
            }

            .sidebar-nav::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
            }

            .sidebar-nav::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.3);
                border-radius: 2px;
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
                position: relative;
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
                transition: all 0.3s ease;
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
                justify-content: between;
                align-items: center;
                min-height: var(--header-height);
            }

            .header-left {
                display: flex;
                align-items: center;
            }

            .header-right {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-left: auto;
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

            .user-menu:hover {
                background: #f8fafc;
                border-color: var(--primary-color);
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

                .mobile-toggle {
                    display: block !important;
                }
            }

            @media (min-width: 769px) {
                .mobile-toggle {
                    display: none !important;
                }
            }

            /* Utility Classes */
            .badge {
                border-radius: 50px;
                font-weight: 500;
                padding: 0.375rem 0.75rem;
            }

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

            .btn {
                border-radius: 0.5rem;
                font-weight: 500;
                padding: 0.5rem 1rem;
                transition: all 0.2s ease;
            }

            .btn:hover {
                transform: translateY(-1px);
            }

            .form-control, .form-select {
                border-radius: 0.5rem;
                border: 1px solid #d1d5db;
                padding: 0.625rem 0.875rem;
                transition: all 0.2s ease;
            }

            .form-control:focus, .form-select:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
            }

            .table th {
                background-color: #f8fafc;
                border: none;
                font-weight: 600;
                color: var(--dark-color);
                padding: 1rem;
            }

            .table td {
                border: none;
                padding: 0.875rem 1rem;
                border-bottom: 1px solid #e2e8f0;
            }

            .alert {
                border: none;
                border-radius: 0.75rem;
                padding: 1rem 1.25rem;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <!-- Dashboard -->
                <div class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Tableau de Bord</span>
                    </a>
                </div>

                <!-- Gestion Section -->
                <div class="nav-section">Gestion</div>
                
                @can('viewAny', App\Models\Classe::class)
                <div class="nav-item">
                    <a href="{{ route('classes.index') }}" class="nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">
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

                <!-- Emplois du Temps Section -->
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
                <!-- Administration Section -->
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

                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Rapports</span>
                    </a>
                </div>
                @endhasrole
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-wrapper" id="mainWrapper">
            <!-- Top Header -->
            <header class="top-header">
                <div class="header-left">
                    <button class="btn btn-outline-secondary mobile-toggle d-md-none me-3" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    @isset($header)
                        {{ $header }}
                    @endisset
                </div>

                <div class="header-right">
                    <!-- User Status -->
                    <span class="badge bg-success">
                        <i class="fas fa-circle me-1" style="font-size: 0.6em;"></i>
                        En ligne
                    </span>

                    <!-- User Menu -->
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
                {{ $slot }}
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
                    const toggle = document.querySelector('.mobile-toggle');
                    
                    if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                const sidebar = document.getElementById('sidebar');
                const mainWrapper = document.getElementById('mainWrapper');
                
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                }
            });
        </script>
    </body>
</html>
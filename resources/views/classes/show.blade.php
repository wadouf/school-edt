<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institut Polyvalent Bilingue Les Pintades - Détails Classe</title>
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
            transition: all 0.3s ease;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 18px;
        }

        .school-name {
            font-size: 16px;
            font-weight: 600;
            line-height: 1.2;
            margin: 0;
        }

        .school-subtitle {
            font-size: 12px;
            opacity: 0.7;
            margin: 0;
        }

        .nav-menu {
            padding: 1rem 0;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.6;
            margin: 0 1.5rem 0.75rem;
        }

        .nav-item {
            margin: 2px 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(4px);
        }

        .nav-link.active {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .nav-icon {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .top-bar {
            background: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .page-title i {
            margin-right: 12px;
            color: var(--primary-color);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
        }

        .content-area {
            padding: 2rem;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #5b6470;
            color: white;
            text-decoration: none;
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            color: white;
            text-decoration: none;
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            color: white;
            text-decoration: none;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .stat-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: 8px;
            color: white;
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: #6b7280;
        }

        .info-value {
            font-weight: 600;
            color: #1f2937;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .content-area {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <h1 class="school-name">Institut Les Pintades</h1>
                    <p class="school-subtitle">Gestion des Emplois du Temps</p>
                </div>
            </div>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-section">
                <h6 class="nav-section-title">Tableau de Bord</h6>
                <div class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        Dashboard
                    </a>
                </div>
            </div>
            
            <div class="nav-section">
                <h6 class="nav-section-title">Gestion Pédagogique</h6>
                <div class="nav-item">
                    <a href="{{ route('classes.index') }}" class="nav-link active">
                        <i class="fas fa-users nav-icon"></i>
                        Classes
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        Enseignants
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book nav-icon"></i>
                        Matières
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-door-open nav-icon"></i>
                        Salles
                    </a>
                </div>
            </div>
            
            <div class="nav-section">
                <h6 class="nav-section-title">Emplois du Temps</h6>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar-alt nav-icon"></i>
                        Emplois du Temps
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-clock nav-icon"></i>
                        Créneaux Horaires
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <h1 class="page-title">
                <i class="fas fa-school"></i>
                Détails de la Classe : {{ $classe->nom }}
            </h1>
            <div class="user-info">
                <div class="user-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <div style="font-weight: 500;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 12px; color: #6b7280;">{{ ucfirst(auth()->user()->getRoleNames()->first() ?? 'Utilisateur') }}</div>
                </div>
            </div>
        </div>
        
        <div class="content-area">
            <!-- Actions Bar -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div></div>
                <div class="d-flex gap-2">
                    @can('update', $classe)
                        <a href="{{ route('classes.edit', $classe) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i> Modifier
                        </a>
                    @endcan
                    <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Retour à la liste
                    </a>
                </div>
            </div>

            <!-- Main Info and Stats -->
            <div class="row">
                <!-- Informations principales -->
                <div class="col-lg-8">
                    <div class="info-card">
                        <h3 style="margin-bottom: 1.5rem; font-weight: 600; color: #1f2937;">
                            <i class="fas fa-info-circle me-2" style="color: var(--primary-color);"></i>
                            Informations de Base
                        </h3>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-row">
                                    <span class="info-label">Nom :</span>
                                    <span class="info-value">{{ $classe->nom }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Code :</span>
                                    <span class="info-value">
                                        <code style="background: #f3f4f6; padding: 4px 8px; border-radius: 4px; font-family: monospace;">{{ $classe->code }}</code>
                                    </span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Section :</span>
                                    <span class="info-value">
                                        <span class="badge {{ $classe->section->nom === 'Francophone' ? 'badge-info' : 'badge-danger' }}">
                                            {{ $classe->section->nom }}
                                        </span>
                                    </span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Niveau :</span>
                                    <span class="info-value">{{ $classe->niveau->nom }} ({{ $classe->niveau->code }})</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-row">
                                    <span class="info-label">Filière :</span>
                                    <span class="info-value">{{ $classe->filiere->nom }} ({{ $classe->filiere->code }})</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Capacité Max :</span>
                                    <span class="info-value">
                                        @if($classe->capacite_max)
                                            {{ $classe->capacite_max }} élèves
                                        @else
                                            <span style="color: #6b7280;">Non défini</span>
                                        @endif
                                    </span>
                                </div>
                                @if($classe->salle_principale)
                                <div class="info-row">
                                    <span class="info-label">Salle Principale :</span>
                                    <span class="info-value">{{ $classe->salle_principale }}</span>
                                </div>
                                @endif
                                <div class="info-row">
                                    <span class="info-label">Statut :</span>
                                    <span class="info-value">
                                        @if($classe->actif)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                <i class="fas fa-pause-circle me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="col-lg-4">
                    <div class="info-card">
                        <h3 style="margin-bottom: 1.5rem; font-weight: 600; color: #1f2937;">
                            <i class="fas fa-chart-bar me-2" style="color: var(--success-color);"></i>
                            Statistiques
                        </h3>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-center p-3" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 8px; color: white;">
                                    <div class="stat-number">{{ $stats['emplois_count'] }}</div>
                                    <div class="stat-label">Emplois</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 8px; color: white;">
                                    <div class="stat-number">{{ $stats['heures_semaine'] }}</div>
                                    <div class="stat-label">Heures/sem</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 8px; color: white;">
                                    <div class="stat-number">{{ $stats['matieres_count'] }}</div>
                                    <div class="stat-label">Matières</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 8px; color: white;">
                                    <div class="stat-number">{{ $stats['enseignants_count'] }}</div>
                                    <div class="stat-label">Enseignants</div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                            <div style="font-size: 12px; color: #6b7280;">
                                <div><strong>Créée:</strong> {{ $classe->created_at->format('d/m/Y à H:i') }}</div>
                                <div><strong>Modifiée:</strong> {{ $classe->updated_at->format('d/m/Y à H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emploi du temps de la classe -->
            <div class="info-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 style="margin: 0; font-weight: 600; color: #1f2937;">
                        <i class="fas fa-calendar-alt me-2" style="color: var(--success-color);"></i>
                        Emploi du Temps
                    </h3>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-success btn-sm">
                            <i class="fas fa-plus me-1"></i> Ajouter Créneau
                        </a>
                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="fas fa-download me-1"></i> Exporter PDF
                        </a>
                    </div>
                </div>

                @if($classe->emploisDuTemps->count() > 0)
                    <!-- Tableau des créneaux -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead style="background: #f8fafc;">
                                <tr>
                                    <th>Jour</th>
                                    <th>Heure</th>
                                    <th>Matière</th>
                                    <th>Enseignant</th>
                                    <th>Salle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $jours = ['', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'] @endphp
                                @foreach($classe->emploisDuTemps as $emploi)
                                    <tr>
                                        <td><strong>{{ $jours[$emploi->jour_semaine] ?? 'N/A' }}</strong></td>
                                        <td>
                                            @if($emploi->creneauHoraire)
                                                <code>{{ $emploi->creneauHoraire->heure_debut }} - {{ $emploi->creneauHoraire->heure_fin }}</code>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div style="width: 12px; height: 12px; border-radius: 50%; background: {{ $emploi->matiere->couleur ?? '#6b7280' }}; margin-right: 8px;"></div>
                                                {{ $emploi->matiere->nom ?? 'N/A' }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ $emploi->enseignant->prenom ?? 'N/A' }} 
                                            {{ $emploi->enseignant->nom ?? '' }}
                                        </td>
                                        <td>{{ $emploi->salle->nom ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="btn btn-warning btn-sm" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5" style="color: #6b7280;">
                        <i class="fas fa-calendar-times" style="font-size: 4rem; margin-bottom: 1rem; color: #d1d5db;"></i>
                        <h4>Aucun emploi du temps configuré</h4>
                        <p>Les créneaux horaires apparaîtront ici une fois configurés</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
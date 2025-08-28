<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institut Polyvalent Bilingue Les Pintades - Créer Classe</title>
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

        .nav-badge {
            margin-left: auto;
            background: var(--danger-color);
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
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

        .form-container {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .required {
            color: var(--danger-color);
        }

        .form-control, .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
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

        .code-preview {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .code-display {
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 16px;
            font-weight: 600;
            padding: 0.75rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: var(--primary-color);
        }

        .error-message {
            color: var(--danger-color);
            font-size: 13px;
            margin-top: 0.25rem;
        }

        .help-text {
            font-size: 13px;
            color: #6b7280;
            margin-top: 0.25rem;
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
                <i class="fas fa-plus"></i>
                Créer une Nouvelle Classe
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div></div>
                <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Retour à la liste
                </a>
            </div>
            
            <div class="form-container">
                <form action="{{ route('classes.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Section -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section_id" class="form-label">
                                    Section <span class="required">*</span>
                                </label>
                                <select name="section_id" id="section_id" class="form-select @error('section_id') is-invalid @enderror" required>
                                    <option value="">Sélectionner une section</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                            {{ $section->nom }} - {{ $section->description }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Niveau -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="niveau_id" class="form-label">
                                    Niveau <span class="required">*</span>
                                </label>
                                <select name="niveau_id" id="niveau_id" class="form-select @error('niveau_id') is-invalid @enderror" required>
                                    <option value="">Sélectionner un niveau</option>
                                    @foreach($niveaux as $niveau)
                                        @php
                                            // Associer le niveau à sa section basé sur le cycle
                                            $sectionType = in_array($niveau->cycle, ['Collège', 'Lycée']) ? 'francophone' : 'anglophone';
                                        @endphp
                                        <option value="{{ $niveau->id }}" 
                                                data-section="{{ $sectionType }}"
                                                data-cycle="{{ $niveau->cycle }}"
                                                {{ old('niveau_id') == $niveau->id ? 'selected' : '' }}>
                                            {{ $niveau->nom }} ({{ $niveau->code }}) - {{ $niveau->cycle }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('niveau_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Filière -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="filiere_id" class="form-label">
                                    Filière <span class="required">*</span>
                                </label>
                                <select name="filiere_id" id="filiere_id" class="form-select @error('filiere_id') is-invalid @enderror" required>
                                    <option value="">Sélectionner une filière</option>
                                    @foreach($filieres as $filiere)
                                        <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                            {{ $filiere->nom }} ({{ $filiere->code }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('filiere_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Nom de la classe -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom" class="form-label">
                                    Nom de la Classe <span class="required">*</span>
                                </label>
                                <input type="text" name="nom" id="nom" value="{{ old('nom') }}"
                                       placeholder="Ex: 6ème A1, Form 1 Sciences..."
                                       class="form-control @error('nom') is-invalid @enderror" required>
                                @error('nom')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Code (optionnel - généré automatiquement) -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code" class="form-label">
                                    Code de la Classe (optionnel)
                                </label>
                                <input type="text" name="code" id="code" value="{{ old('code') }}"
                                       placeholder="Généré automatiquement si vide"
                                       class="form-control @error('code') is-invalid @enderror" maxlength="10">
                                @error('code')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <div class="help-text">
                                    Si laissé vide, un code sera généré automatiquement basé sur la section, niveau et filière
                                </div>
                            </div>
                        </div>

                        <!-- Capacité Maximum -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="capacite_max" class="form-label">
                                    Capacité Maximum
                                </label>
                                <input type="number" name="capacite_max" id="capacite_max" 
                                       value="{{ old('capacite_max', 30) }}" min="1" max="50"
                                       class="form-control @error('capacite_max') is-invalid @enderror">
                                @error('capacite_max')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Salle Principale -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="salle_principale" class="form-label">
                                    Salle Principale (optionnel)
                                </label>
                                <input type="text" name="salle_principale" id="salle_principale" 
                                       value="{{ old('salle_principale') }}" placeholder="Ex: Salle 101, Lab Sciences..."
                                       class="form-control @error('salle_principale') is-invalid @enderror">
                                @error('salle_principale')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Statut Actif -->
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="actif" id="actif" value="1" 
                                   {{ old('actif', true) ? 'checked' : '' }} class="form-check-input">
                            <label for="actif" class="form-check-label">
                                Classe active (peut recevoir des emplois du temps)
                            </label>
                        </div>
                    </div>

                    <!-- Aperçu automatique du code -->
                    <div class="code-preview">
                        <h6 style="margin-bottom: 1rem; font-weight: 600;">Aperçu du Code Automatique:</h6>
                        <div id="code-preview" class="code-display">
                            <span style="color: #6b7280;">Sélectionnez section, niveau et filière</span>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Créer la Classe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sectionSelect = document.getElementById('section_id');
            const niveauSelect = document.getElementById('niveau_id');
            const filiereSelect = document.getElementById('filiere_id');
            const codePreview = document.getElementById('code-preview');

            function updateCodePreview() {
                const sectionText = sectionSelect.options[sectionSelect.selectedIndex]?.text || '';
                const niveauText = niveauSelect.options[niveauSelect.selectedIndex]?.text || '';
                const filiereText = filiereSelect.options[filiereSelect.selectedIndex]?.text || '';

                if (sectionSelect.value && niveauSelect.value && filiereSelect.value) {
                    const sectionCode = sectionText.substring(0, 2).toUpperCase();
                    const niveauMatch = niveauText.match(/\(([^)]+)\)/);
                    const niveauCode = niveauMatch ? niveauMatch[1] : niveauText.substring(0, 3);
                    const filiereMatch = filiereText.match(/\(([^)]+)\)/);
                    const filiereCode = filiereMatch ? filiereMatch[1] : filiereText.substring(0, 3).toUpperCase();

                    const generatedCode = sectionCode + niveauCode + filiereCode;
                    codePreview.innerHTML = `<span style="color: var(--primary-color); font-weight: 600;">${generatedCode}</span>`;
                } else {
                    codePreview.innerHTML = '<span style="color: #6b7280;">Sélectionnez section, niveau et filière</span>';
                }
            }

            // Filtrer les niveaux selon la section
            function filterNiveaux() {
                const selectedSection = sectionSelect.options[sectionSelect.selectedIndex]?.text.toLowerCase() || '';
                
                Array.from(niveauSelect.options).forEach(option => {
                    if (option.value === '') return; // Keep empty option
                    
                    const niveauSection = option.dataset.section;
                    if (selectedSection.includes('francophone') && niveauSection === 'francophone') {
                        option.style.display = 'block';
                    } else if (selectedSection.includes('anglophone') && niveauSection === 'anglophone') {
                        option.style.display = 'block';
                    } else if (selectedSection === '') {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                        if (option.selected) {
                            option.selected = false;
                        }
                    }
                });
                
                updateCodePreview();
            }

            sectionSelect.addEventListener('change', filterNiveaux);
            niveauSelect.addEventListener('change', updateCodePreview);
            filiereSelect.addEventListener('change', updateCodePreview);

            // Initial update
            filterNiveaux();
        });
    </script>
</body>
</html>
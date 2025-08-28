<x-guest-layout>
    <!-- Logo et Titre -->
    <div class="text-center mb-4">
        <div class="school-logo">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <h1 class="h4 fw-bold text-primary mb-1">Institut Polyvalent Bilingue</h1>
        <h2 class="h6 text-muted mb-2">Les Pintades</h2>
        <p class="small text-muted">Système de Gestion d'Emplois du Temps</p>
    </div>

    <!-- Comptes de démonstration -->
    <div class="demo-accounts mb-4">
        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-info-circle text-primary me-2"></i>
            <small class="fw-semibold text-primary">Comptes de Démonstration</small>
        </div>
        <div class="row g-2">
            <div class="col-12 col-sm-4">
                <div class="demo-account text-center">
                    <div class="fw-bold text-primary small">Admin</div>
                    <div class="small text-muted">admin@ecole.fr</div>
                    <div class="small text-muted">admin123</div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="demo-account text-center">
                    <div class="fw-bold text-success small">Chef</div>
                    <div class="small text-muted">chef@ecole.fr</div>
                    <div class="small text-muted">chef123</div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="demo-account text-center">
                    <div class="fw-bold text-info small">Enseignant</div>
                    <div class="small text-muted">j.dupont@ecole.fr</div>
                    <div class="small text-muted">password123</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages de statut -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <!-- Formulaire de connexion -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">
                <i class="fas fa-envelope text-muted me-1"></i>
                Adresse E-mail
            </label>
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="votre.email@ecole.fr"
                   required 
                   autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">
                <i class="fas fa-lock text-muted me-1"></i>
                Mot de Passe
            </label>
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   placeholder="Votre mot de passe"
                   required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Se souvenir -->
        <div class="mb-4">
            <div class="form-check">
                <input type="checkbox" 
                       class="form-check-input" 
                       id="remember_me" 
                       name="remember">
                <label class="form-check-label text-muted" for="remember_me">
                    Se souvenir de moi
                </label>
            </div>
        </div>

        <!-- Actions -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-sign-in-alt me-2"></i>
                Se Connecter
            </button>
        </div>

        <!-- Mot de passe oublié -->
        @if (Route::has('password.request'))
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}" 
                   class="text-decoration-none text-muted small">
                    <i class="fas fa-key me-1"></i>
                    Mot de passe oublié ?
                </a>
            </div>
        @endif
    </form>

    <!-- Footer -->
    <div class="text-center mt-4 pt-3 border-top">
        <p class="small text-muted mb-1">
            <i class="fas fa-map-marker-alt me-1"></i>
            Institut Polyvalent Bilingue Les Pintades
        </p>
        <p class="small text-muted mb-0">
            <i class="fas fa-globe me-1"></i>
            Cameroun • Système Bilingue
        </p>
    </div>

    <script>
        // Auto-remplissage rapide pour demo (optionnel)
        document.addEventListener('DOMContentLoaded', function() {
            const demoAccounts = document.querySelectorAll('.demo-account');
            demoAccounts.forEach(account => {
                account.addEventListener('click', function() {
                    const emails = {
                        'Admin': 'admin@ecole.fr',
                        'Chef': 'chef@ecole.fr', 
                        'Enseignant': 'j.dupont@ecole.fr'
                    };
                    const passwords = {
                        'Admin': 'admin123',
                        'Chef': 'chef123',
                        'Enseignant': 'password123'
                    };
                    
                    const role = this.querySelector('.fw-bold').textContent;
                    document.getElementById('email').value = emails[role] || '';
                    document.getElementById('password').value = passwords[role] || '';
                });
            });
        });
    </script>
</x-guest-layout>
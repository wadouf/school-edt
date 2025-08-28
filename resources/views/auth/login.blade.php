<x-guest-layout>
    <div class="text-center mb-6">
        <!-- Logo/Titre de l'établissement -->
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-school text-blue-600 mr-2"></i>
                Institut Polyvalent Bilingue
            </h1>
            <h2 class="text-lg text-gray-600">Les Pintades</h2>
            <p class="text-sm text-gray-500 mt-2">Système de Gestion d'Emplois du Temps</p>
        </div>
        
        <!-- Informations de connexion pour demo -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
            <p class="text-xs text-blue-800 font-medium mb-2">
                <i class="fas fa-info-circle mr-1"></i> Comptes de Démonstration
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-xs">
                <div class="bg-white rounded p-2">
                    <strong class="text-blue-700">Admin</strong><br>
                    admin@ecole.fr<br>
                    admin123
                </div>
                <div class="bg-white rounded p-2">
                    <strong class="text-green-700">Chef</strong><br>
                    chef@ecole.fr<br>
                    chef123
                </div>
                <div class="bg-white rounded p-2">
                    <strong class="text-purple-700">Enseignant</strong><br>
                    j.dupont@ecole.fr<br>
                    password123
                </div>
            </div>
        </div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Adresse E-mail')" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <x-text-input id="email" 
                    class="block mt-1 w-full pl-10" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username"
                    placeholder="votre.email@ecole.fr" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de Passe')" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <x-text-input id="password" 
                    class="block mt-1 w-full pl-10"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password"
                    placeholder="Votre mot de passe" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">
                    <i class="fas fa-remember me-1"></i> {{ __('Se souvenir de moi') }}
                </span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                   href="{{ route('password.request') }}">
                    <i class="fas fa-key mr-1"></i>
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                <i class="fas fa-sign-in-alt mr-2"></i>
                {{ __('Se Connecter') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Footer -->
    <div class="mt-8 text-center">
        <p class="text-xs text-gray-500">
            <i class="fas fa-map-marker-alt mr-1"></i>
            Institut Polyvalent Bilingue Les Pintades - Cameroun
        </p>
        <p class="text-xs text-gray-400 mt-1">
            Système développé pour la gestion des emplois du temps bilingues
        </p>
    </div>

    <style>
        /* Améliorations des styles pour les inputs avec icônes */
        .relative input[type="email"],
        .relative input[type="password"] {
            padding-left: 2.5rem;
        }

        /* Style pour le bouton primaire */
        .bg-blue-600 {
            background-color: #2563eb;
        }

        .hover\:bg-blue-700:hover {
            background-color: #1d4ed8;
        }

        .focus\:ring-blue-500:focus {
            --tw-ring-color: #3b82f6;
        }
    </style>
</x-guest-layout>
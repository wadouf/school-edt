<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-tie"></i> Tableau de Bord - Chef d'Établissement
        </h2>
    </x-slot>
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Statistiques générales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $stats['classes'] }}</div>
                    <div class="text-sm text-gray-600">Classes Total</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-green-600">{{ $classesCount['francophone'] }}</div>
                    <div class="text-sm text-gray-600">Classes Francophones</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-red-600">{{ $classesCount['anglophone'] }}</div>
                    <div class="text-sm text-gray-600">Classes Anglophones</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-purple-600">{{ $stats['enseignants'] }}</div>
                    <div class="text-sm text-gray-600">Enseignants</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Gestion Pédagogique -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-graduation-cap"></i> Gestion Pédagogique
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('classes.index') }}" class="block w-full btn btn-primary">
                            <i class="fas fa-school mr-2"></i> Gérer les Classes
                        </a>
                        <a href="#" class="block w-full btn btn-success">
                            <i class="fas fa-chalkboard-teacher mr-2"></i> Gérer les Enseignants
                        </a>
                        <a href="#" class="block w-full btn btn-info">
                            <i class="fas fa-book mr-2"></i> Gérer les Matières
                        </a>
                        <a href="#" class="block w-full btn btn-warning">
                            <i class="fas fa-door-open mr-2"></i> Gérer les Salles
                        </a>
                    </div>
                </div>
            </div>

            <!-- Emplois du Temps -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-calendar-alt"></i> Emplois du Temps
                    </h3>
                    <div class="space-y-3">
                        <a href="#" class="block w-full btn btn-dark">
                            <i class="fas fa-plus mr-2"></i> Créer Nouvel Emploi
                        </a>
                        <a href="#" class="block w-full btn btn-secondary">
                            <i class="fas fa-eye mr-2"></i> Voir Tous les Emplois
                        </a>
                        <a href="#" class="block w-full btn btn-outline-primary">
                            <i class="fas fa-robot mr-2"></i> Génération Automatique
                        </a>
                        <a href="#" class="block w-full btn btn-outline-success">
                            <i class="fas fa-file-pdf mr-2"></i> Exporter PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Rapports -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-chart-bar"></i> Rapports & Analyses
                    </h3>
                    <div class="space-y-3">
                        <a href="#" class="block w-full btn btn-outline-info">
                            <i class="fas fa-clock mr-2"></i> Charge Enseignants
                        </a>
                        <a href="#" class="block w-full btn btn-outline-warning">
                            <i class="fas fa-exclamation-triangle mr-2"></i> Conflits Détectés
                        </a>
                        <a href="#" class="block w-full btn btn-outline-secondary">
                            <i class="fas fa-building mr-2"></i> Utilisation Salles
                        </a>
                        <a href="#" class="block w-full btn btn-outline-dark">
                            <i class="fas fa-download mr-2"></i> Export Excel
                        </a>
                    </div>
                </div>
            </div>

            <!-- Emplois du Temps Récents -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg lg:col-span-3">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-history"></i> Emplois du Temps Récents
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="table table-striped w-full">
                            <thead>
                                <tr>
                                    <th>Classe</th>
                                    <th>Enseignant</th>
                                    <th>Matière</th>
                                    <th>Salle</th>
                                    <th>Jour</th>
                                    <th>Créé le</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($emploisDuTemps as $emploi)
                                    <tr>
                                        <td>
                                            <span class="font-semibold">{{ $emploi->classe->nom ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            {{ $emploi->enseignant->prenom ?? 'N/A' }} 
                                            {{ $emploi->enseignant->nom ?? '' }}
                                        </td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $emploi->matiere->couleur ?? '#6B7280' }}; color: white;">
                                                {{ $emploi->matiere->nom ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>{{ $emploi->salle->nom ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                                            @endphp
                                            {{ $jours[$emploi->jour_semaine - 1] ?? 'N/A' }}
                                        </td>
                                        <td>{{ $emploi->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="flex space-x-2">
                                                <a href="#" class="btn btn-sm btn-outline-primary">Modifier</a>
                                                <a href="#" class="btn btn-sm btn-outline-danger">Supprimer</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-gray-500 py-8">
                                            <i class="fas fa-calendar-times text-4xl mb-2"></i><br>
                                            Aucun emploi du temps configuré
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

<style>
.btn {
    @apply inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200;
}

.btn-primary {
    @apply bg-blue-600 text-white hover:bg-blue-700;
}

.btn-success {
    @apply bg-green-600 text-white hover:bg-green-700;
}

.btn-warning {
    @apply bg-yellow-500 text-white hover:bg-yellow-600;
}

.btn-info {
    @apply bg-cyan-500 text-white hover:bg-cyan-600;
}

.btn-dark {
    @apply bg-gray-800 text-white hover:bg-gray-900;
}

.btn-secondary {
    @apply bg-gray-600 text-white hover:bg-gray-700;
}

.btn-outline-primary {
    @apply border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white;
}

.btn-outline-success {
    @apply border border-green-600 text-green-600 hover:bg-green-600 hover:text-white;
}

.btn-outline-info {
    @apply border border-cyan-500 text-cyan-500 hover:bg-cyan-500 hover:text-white;
}

.btn-outline-warning {
    @apply border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white;
}

.btn-outline-secondary {
    @apply border border-gray-600 text-gray-600 hover:bg-gray-600 hover:text-white;
}

.btn-outline-dark {
    @apply border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white;
}

.btn-outline-danger {
    @apply border border-red-600 text-red-600 hover:bg-red-600 hover:text-white;
}

.btn-sm {
    @apply px-2 py-1 text-xs;
}

.table {
    @apply w-full text-sm text-left;
}

.table-striped tbody tr:nth-child(odd) {
    @apply bg-gray-50;
}

.table th {
    @apply px-4 py-3 font-semibold text-gray-700 bg-gray-100;
}

.table td {
    @apply px-4 py-3 text-gray-600;
}

.badge {
    @apply inline-block px-2 py-1 text-xs font-semibold rounded-full;
}
</style>
</x-app-layout>
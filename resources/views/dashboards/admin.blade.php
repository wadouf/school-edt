<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-user-cog"></i> Tableau de Bord - Administrateur
        </h2>
    </x-slot>
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Statistiques générales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $stats['classes'] }}</div>
                    <div class="text-sm text-gray-600">Classes</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-green-600">{{ $stats['enseignants'] }}</div>
                    <div class="text-sm text-gray-600">Enseignants</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-purple-600">{{ $stats['matieres'] }}</div>
                    <div class="text-sm text-gray-600">Matières</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-orange-600">{{ $stats['salles'] }}</div>
                    <div class="text-sm text-gray-600">Salles</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-red-600">{{ $stats['emplois'] }}</div>
                    <div class="text-sm text-gray-600">Emplois</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-indigo-600">{{ $stats['creneaux'] }}</div>
                    <div class="text-sm text-gray-600">Créneaux</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Gestion Rapide -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-tools"></i> Gestion Rapide
                    </h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-users"></i> Gérer Utilisateurs
                        </a>
                        <a href="{{ route('classes.index') }}" class="btn btn-success">
                            <i class="fas fa-school"></i> Gérer Classes
                        </a>
                        <a href="#" class="btn btn-warning">
                            <i class="fas fa-chalkboard-teacher"></i> Gérer Enseignants
                        </a>
                        <a href="#" class="btn btn-info">
                            <i class="fas fa-book"></i> Gérer Matières
                        </a>
                        <a href="#" class="btn btn-dark">
                            <i class="fas fa-door-open"></i> Gérer Salles
                        </a>
                        <a href="#" class="btn btn-secondary">
                            <i class="fas fa-calendar-alt"></i> Emplois du Temps
                        </a>
                    </div>
                </div>
            </div>

            <!-- Activités Récentes -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-history"></i> Activités Récentes
                    </h3>
                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @forelse($recentActivities as $activity)
                            <div class="flex items-start space-x-3 text-sm">
                                <div class="flex-shrink-0">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-700">{{ $activity->description }}</p>
                                    <p class="text-gray-500 text-xs">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Aucune activité récente</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Utilisateurs Récents -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg lg:col-span-2">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-user-plus"></i> Utilisateurs Récents
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="table table-striped w-full">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Créé le</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                <span class="badge bg-primary">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Modifier</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500">Aucun utilisateur</td>
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
    @apply inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200;
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

.bg-primary {
    @apply bg-blue-100 text-blue-800;
}
</style>
</x-app-layout>
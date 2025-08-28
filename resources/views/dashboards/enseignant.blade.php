<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-chalkboard-teacher"></i> Tableau de Bord - Enseignant
            @if($enseignant)
                <span class="text-base text-gray-600">- {{ $enseignant->prenom }} {{ $enseignant->nom }}</span>
            @endif
        </h2>
    </x-slot>
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(!$enseignant)
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Votre profil enseignant n'est pas encore configuré. Veuillez contacter l'administration.
            </div>
        @else
            <!-- Informations Personnelles -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-id-card"></i> Mes Informations
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Type</label>
                            <div class="mt-1">
                                <span class="badge {{ $enseignant->type === 'permanent' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($enseignant->type) }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Spécialité</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $enseignant->specialite ?? 'Non spécifiée' }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $enseignant->telephone ?? 'Non renseigné' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mes Matières -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">
                            <i class="fas fa-book"></i> Mes Matières ({{ $mesMatieres->count() }})
                        </h3>
                        @if($mesMatieres->count() > 0)
                            <div class="grid grid-cols-1 gap-2">
                                @foreach($mesMatieres as $matiere)
                                    <div class="flex items-center justify-between p-3 border rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $matiere->couleur }}"></div>
                                            <span class="font-medium">{{ $matiere->nom }}</span>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            @if($matiere->necessite_laboratoire)
                                                <i class="fas fa-flask" title="Nécessite un laboratoire"></i>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">
                                <i class="fas fa-book-open text-3xl mb-2"></i><br>
                                Aucune matière assignée
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Statistiques Rapides -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">
                            <i class="fas fa-chart-pie"></i> Mes Statistiques
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Cours cette semaine</span>
                                <span class="text-2xl font-bold text-blue-600">{{ $mesEmplois->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Matières enseignées</span>
                                <span class="text-2xl font-bold text-green-600">{{ $mesMatieres->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Disponibilités définies</span>
                                <span class="text-2xl font-bold text-purple-600">{{ $mesDisponibilites->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mon Emploi du Temps -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">
                            <i class="fas fa-calendar-week"></i> Mon Emploi du Temps
                        </h3>
                        <div class="space-x-2">
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye mr-1"></i> Vue Détaillée
                            </a>
                            <a href="#" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-download mr-1"></i> Exporter
                            </a>
                        </div>
                    </div>

                    @if($mesEmplois->count() > 0)
                        <!-- Grille simplifiée par jour -->
                        @php
                            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
                            $emploisParJour = $mesEmplois->groupBy('jour_semaine');
                        @endphp
                        
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            @foreach([1,2,3,4,5] as $jourIndex)
                                <div class="border rounded-lg p-3">
                                    <h4 class="font-semibold text-center mb-3 text-gray-700">
                                        {{ $jours[$jourIndex-1] }}
                                    </h4>
                                    @if(isset($emploisParJour[$jourIndex]))
                                        <div class="space-y-2">
                                            @foreach($emploisParJour[$jourIndex] as $emploi)
                                                <div class="p-2 rounded text-xs" style="background-color: {{ $emploi->matiere->couleur ?? '#6B7280' }}20; border-left: 3px solid {{ $emploi->matiere->couleur ?? '#6B7280' }}">
                                                    <div class="font-semibold">{{ $emploi->matiere->nom ?? 'Matière' }}</div>
                                                    <div class="text-gray-600">{{ $emploi->classe->nom ?? 'Classe' }}</div>
                                                    <div class="text-gray-500">{{ $emploi->salle->nom ?? 'Salle' }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-400 text-xs text-center py-4">Aucun cours</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Liste détaillée -->
                        <div class="mt-6">
                            <h4 class="font-semibold mb-3">Détail des cours</h4>
                            <div class="overflow-x-auto">
                                <table class="table table-striped w-full">
                                    <thead>
                                        <tr>
                                            <th>Jour</th>
                                            <th>Heure</th>
                                            <th>Matière</th>
                                            <th>Classe</th>
                                            <th>Salle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mesEmplois as $emploi)
                                            <tr>
                                                <td>{{ $jours[$emploi->jour_semaine - 1] ?? 'N/A' }}</td>
                                                <td>
                                                    @if($emploi->creneauHoraire)
                                                        {{ $emploi->creneauHoraire->heure_debut }} - {{ $emploi->creneauHoraire->heure_fin }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge" style="background-color: {{ $emploi->matiere->couleur ?? '#6B7280' }}; color: white;">
                                                        {{ $emploi->matiere->nom ?? 'N/A' }}
                                                    </span>
                                                </td>
                                                <td>{{ $emploi->classe->nom ?? 'N/A' }}</td>
                                                <td>{{ $emploi->salle->nom ?? 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-calendar-times text-4xl mb-4"></i>
                            <p>Aucun cours programmé pour le moment</p>
                            <p class="text-sm">Votre emploi du temps sera bientôt disponible</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions Rapides -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-bolt"></i> Actions Rapides
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-clock mr-2"></i> Mes Disponibilités
                        </a>
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-calendar-plus mr-2"></i> Demander Modification
                        </a>
                        <a href="#" class="btn btn-info">
                            <i class="fas fa-file-export mr-2"></i> Exporter iCal
                        </a>
                        <a href="#" class="btn btn-warning">
                            <i class="fas fa-comments mr-2"></i> Contacter Admin
                        </a>
                    </div>
                </div>
            </div>
        @endif
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

.btn-info {
    @apply bg-cyan-500 text-white hover:bg-cyan-600;
}

.btn-warning {
    @apply bg-yellow-500 text-white hover:bg-yellow-600;
}

.btn-outline-primary {
    @apply border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white;
}

.btn-outline-success {
    @apply border border-green-600 text-green-600 hover:bg-green-600 hover:text-white;
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

.bg-success {
    @apply bg-green-100 text-green-800;
}

.bg-warning {
    @apply bg-yellow-100 text-yellow-800;
}
</style>
</x-app-layout>
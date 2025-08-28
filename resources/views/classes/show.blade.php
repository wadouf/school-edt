<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-school mr-2"></i> Détails de la Classe: {{ $classe->nom }}
            </h2>
            <div class="space-x-2">
                @can('update', $classe)
                    <a href="{{ route('classes.edit', $classe) }}" class="btn btn-primary">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>
                @endcan
                <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations principales -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Détails de base -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Informations de Base</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                                    <div class="mt-1 text-lg text-gray-900">{{ $classe->nom }}</div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Code</label>
                                    <div class="mt-1">
                                        <span class="font-mono text-lg bg-gray-100 px-3 py-1 rounded">{{ $classe->code }}</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Section</label>
                                    <div class="mt-1">
                                        <span class="badge {{ $classe->section->nom === 'Francophone' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $classe->section->nom }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $classe->section->description }}</div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Niveau</label>
                                    <div class="mt-1 text-gray-900">{{ $classe->niveau->nom }}</div>
                                    <div class="text-sm text-gray-500">Code: {{ $classe->niveau->code }}</div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Filière</label>
                                    <div class="mt-1 text-gray-900">{{ $classe->filiere->nom }}</div>
                                    <div class="text-sm text-gray-500">Code: {{ $classe->filiere->code }}</div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Effectif Maximum</label>
                                    <div class="mt-1 text-gray-900">
                                        @if($classe->effectif_max)
                                            {{ $classe->effectif_max }} élèves
                                        @else
                                            <span class="text-gray-400">Non défini</span>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($classe->salle_attitre)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Salle Attitrée</label>
                                        <div class="mt-1 text-gray-900">{{ $classe->salle_attitre }}</div>
                                    </div>
                                @endif
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Statut</label>
                                    <div class="mt-1">
                                        @if($classe->actif)
                                            <span class="badge bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge bg-gray-100 text-gray-800">
                                                <i class="fas fa-pause-circle mr-1"></i>Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistiques -->
                <div>
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Statistiques</h3>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Emplois du temps</span>
                                    <span class="text-2xl font-bold text-blue-600">{{ $stats['emplois_count'] }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Heures/semaine</span>
                                    <span class="text-2xl font-bold text-green-600">{{ $stats['heures_semaine'] }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Matières</span>
                                    <span class="text-2xl font-bold text-purple-600">{{ $stats['matieres_count'] }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Enseignants</span>
                                    <span class="text-2xl font-bold text-orange-600">{{ $stats['enseignants_count'] }}</span>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t">
                                <div class="text-xs text-gray-500 space-y-1">
                                    <div><strong>Créée:</strong> {{ $classe->created_at->format('d/m/Y') }}</div>
                                    <div><strong>Modifiée:</strong> {{ $classe->updated_at->format('d/m/Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emploi du temps de la classe -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Emploi du Temps</h3>
                        <div class="space-x-2">
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus mr-1"></i> Ajouter un Créneau
                            </a>
                            <a href="#" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-download mr-1"></i> Exporter PDF
                            </a>
                        </div>
                    </div>

                    @if($classe->emploisDuTemps->count() > 0)
                        <!-- Grille par jour -->
                        @php
                            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
                            $emploisParJour = $classe->emploisDuTemps->groupBy('jour_semaine');
                        @endphp
                        
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                            @foreach([1,2,3,4,5] as $jourIndex)
                                <div class="border rounded-lg p-3">
                                    <h4 class="font-semibold text-center mb-3 text-gray-700 bg-gray-50 py-2 rounded">
                                        {{ $jours[$jourIndex-1] }}
                                    </h4>
                                    @if(isset($emploisParJour[$jourIndex]))
                                        <div class="space-y-2">
                                            @foreach($emploisParJour[$jourIndex] as $emploi)
                                                <div class="p-2 rounded text-xs border-l-4" style="border-left-color: {{ $emploi->matiere->couleur ?? '#6B7280' }}; background-color: {{ $emploi->matiere->couleur ?? '#6B7280' }}10;">
                                                    <div class="font-semibold text-gray-800">{{ $emploi->matiere->nom ?? 'Matière' }}</div>
                                                    <div class="text-gray-600">{{ $emploi->enseignant->nom ?? 'Enseignant' }}</div>
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
                        <div class="overflow-x-auto">
                            <table class="table table-striped w-full">
                                <thead>
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
                                    @foreach($classe->emploisDuTemps as $emploi)
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
                                                <div class="flex items-center">
                                                    <div class="w-3 h-3 rounded-full mr-2" style="background-color: {{ $emploi->matiere->couleur ?? '#6B7280' }}"></div>
                                                    {{ $emploi->matiere->nom ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $emploi->enseignant->prenom ?? 'N/A' }} 
                                                {{ $emploi->enseignant->nom ?? '' }}
                                            </td>
                                            <td>{{ $emploi->salle->nom ?? 'N/A' }}</td>
                                            <td>
                                                <div class="flex space-x-1">
                                                    <a href="#" class="btn btn-sm btn-outline-warning" title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-calendar-times text-4xl mb-4"></i>
                            <p class="text-lg">Aucun emploi du temps configuré</p>
                            <p class="text-sm">Les créneaux horaires apparaîtront ici une fois configurés</p>
                        </div>
                    @endif
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
        .btn-secondary {
            @apply bg-gray-600 text-white hover:bg-gray-700;
        }
        .btn-outline-primary {
            @apply border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white;
        }
        .btn-outline-success {
            @apply border border-green-600 text-green-600 hover:bg-green-600 hover:text-white;
        }
        .btn-outline-warning {
            @apply border border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white;
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
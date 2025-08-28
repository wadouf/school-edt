<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-school mr-2"></i> Gestion des Classes
            </h2>
            @can('create', App\Models\Classe::class)
                <a href="{{ route('classes.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i> Nouvelle Classe
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Filtres et Recherche -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <form method="GET" action="{{ route('classes.index') }}" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Recherche</label>
                            <input type="text" 
                                   name="search" 
                                   id="search"
                                   value="{{ request('search') }}"
                                   placeholder="Nom ou code..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="section_id" class="block text-sm font-medium text-gray-700">Section</label>
                            <select name="section_id" id="section_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Toutes les sections</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                        {{ $section->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="niveau_id" class="block text-sm font-medium text-gray-700">Niveau</label>
                            <select name="niveau_id" id="niveau_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Tous les niveaux</option>
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}" {{ request('niveau_id') == $niveau->id ? 'selected' : '' }}>
                                        {{ $niveau->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="filiere_id" class="block text-sm font-medium text-gray-700">Filière</label>
                            <select name="filiere_id" id="filiere_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Toutes les filières</option>
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ request('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search mr-1"></i> Filtrer
                            </button>
                            <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Actions en lot -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium">
                                {{ $classes->total() }} classe(s) trouvée(s)
                            </h3>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('classes.export', ['format' => 'csv'] + request()->query()) }}" 
                               class="btn btn-outline-success btn-sm">
                                <i class="fas fa-file-csv mr-1"></i> Export CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des Classes -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="overflow-x-auto">
                    <table class="table table-striped w-full">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Section</th>
                                <th>Niveau</th>
                                <th>Filière</th>
                                <th>Effectif Max</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classes as $classe)
                                <tr>
                                    <td>
                                        <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">
                                            {{ $classe->code }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="font-medium">{{ $classe->nom }}</div>
                                        @if($classe->salle_attitre)
                                            <div class="text-xs text-gray-500">Salle: {{ $classe->salle_attitre }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $classe->section->nom === 'Francophone' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $classe->section->nom ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $classe->niveau->nom ?? 'N/A' }}</td>
                                    <td>{{ $classe->filiere->nom ?? 'N/A' }}</td>
                                    <td>
                                        @if($classe->effectif_max)
                                            <span class="text-sm">{{ $classe->effectif_max }} élèves</span>
                                        @else
                                            <span class="text-gray-400">Non défini</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($classe->actif)
                                            <span class="badge bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>Actif
                                            </span>
                                        @else
                                            <span class="badge bg-gray-100 text-gray-800">
                                                <i class="fas fa-pause-circle mr-1"></i>Inactif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex space-x-1">
                                            @can('view', $classe)
                                                <a href="{{ route('classes.show', $classe) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Voir">
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
                                                <form action="{{ route('classes.destroy', $classe) }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-8 text-gray-500">
                                        <i class="fas fa-school text-4xl mb-4"></i><br>
                                        Aucune classe trouvée
                                        @if(request()->hasAny(['search', 'section_id', 'niveau_id', 'filiere_id']))
                                            <br><a href="{{ route('classes.index') }}" class="text-blue-600 hover:underline">Voir toutes les classes</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($classes->hasPages())
                    <div class="px-6 py-3 border-t">
                        {{ $classes->links() }}
                    </div>
                @endif
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
        .btn-outline-warning {
            @apply border border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white;
        }
        .btn-outline-danger {
            @apply border border-red-600 text-red-600 hover:bg-red-600 hover:text-white;
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
    </style>
</x-app-layout>
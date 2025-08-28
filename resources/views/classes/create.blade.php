<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-plus mr-2"></i> Créer une Nouvelle Classe
            </h2>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <form action="{{ route('classes.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Section -->
                        <div>
                            <label for="section_id" class="block text-sm font-medium text-gray-700">
                                Section <span class="text-red-500">*</span>
                            </label>
                            <select name="section_id" id="section_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('section_id') border-red-500 @enderror"
                                    required>
                                <option value="">Sélectionner une section</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                        {{ $section->nom }} - {{ $section->description }}
                                    </option>
                                @endforeach
                            </select>
                            @error('section_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Niveau -->
                        <div>
                            <label for="niveau_id" class="block text-sm font-medium text-gray-700">
                                Niveau <span class="text-red-500">*</span>
                            </label>
                            <select name="niveau_id" id="niveau_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('niveau_id') border-red-500 @enderror"
                                    required>
                                <option value="">Sélectionner un niveau</option>
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}" 
                                            data-section="{{ $niveau->section }}"
                                            {{ old('niveau_id') == $niveau->id ? 'selected' : '' }}>
                                        {{ $niveau->nom }} ({{ $niveau->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('niveau_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Filière -->
                        <div>
                            <label for="filiere_id" class="block text-sm font-medium text-gray-700">
                                Filière <span class="text-red-500">*</span>
                            </label>
                            <select name="filiere_id" id="filiere_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('filiere_id') border-red-500 @enderror"
                                    required>
                                <option value="">Sélectionner une filière</option>
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                        {{ $filiere->nom }} ({{ $filiere->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('filiere_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nom de la classe -->
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700">
                                Nom de la Classe <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="nom" 
                                   id="nom"
                                   value="{{ old('nom') }}"
                                   placeholder="Ex: 6ème A1, Form 1 Sciences..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nom') border-red-500 @enderror"
                                   required>
                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Code (optionnel - généré automatiquement) -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700">
                                Code de la Classe (optionnel)
                            </label>
                            <input type="text" 
                                   name="code" 
                                   id="code"
                                   value="{{ old('code') }}"
                                   placeholder="Généré automatiquement si vide"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('code') border-red-500 @enderror"
                                   maxlength="10">
                            @error('code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                Si laissé vide, un code sera généré automatiquement basé sur la section, niveau et filière
                            </p>
                        </div>

                        <!-- Effectif Maximum -->
                        <div>
                            <label for="effectif_max" class="block text-sm font-medium text-gray-700">
                                Effectif Maximum
                            </label>
                            <input type="number" 
                                   name="effectif_max" 
                                   id="effectif_max"
                                   value="{{ old('effectif_max', 30) }}"
                                   min="1"
                                   max="50"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('effectif_max') border-red-500 @enderror">
                            @error('effectif_max')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Salle Attitré -->
                        <div>
                            <label for="salle_attitre" class="block text-sm font-medium text-gray-700">
                                Salle Attitrée (optionnel)
                            </label>
                            <input type="text" 
                                   name="salle_attitre" 
                                   id="salle_attitre"
                                   value="{{ old('salle_attitre') }}"
                                   placeholder="Ex: Salle 101, Lab Sciences..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('salle_attitre') border-red-500 @enderror">
                            @error('salle_attitre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Statut Actif -->
                    <div class="mt-6">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="actif" 
                                   id="actif"
                                   value="1"
                                   {{ old('actif', true) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="actif" class="ml-2 block text-sm text-gray-700">
                                Classe active (peut recevoir des emplois du temps)
                            </label>
                        </div>
                    </div>

                    <!-- Aperçu automatique du code -->
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Aperçu du Code Automatique:</h4>
                        <div id="code-preview" class="text-lg font-mono bg-white px-3 py-2 rounded border">
                            <span class="text-gray-400">Sélectionnez section, niveau et filière</span>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i> Créer la Classe
                        </button>
                    </div>
                </form>
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
    </style>

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
                    codePreview.innerHTML = `<span class="text-blue-600">${generatedCode}</span>`;
                } else {
                    codePreview.innerHTML = '<span class="text-gray-400">Sélectionnez section, niveau et filière</span>';
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
</x-app-layout>
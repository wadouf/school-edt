@extends('layouts.app')

@section('title', 'Créer une Salle - Institut Les Pintades')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Créer une Salle</h1>
                    <p class="text-muted">Ajouter une nouvelle salle de classe ou laboratoire</p>
                </div>
                <a href="{{ route('salles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Retour à la liste
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-door-open me-2"></i>
                        Informations de la salle
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('salles.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Nom -->
                            <div class="col-md-6">
                                <label for="nom" class="form-label">
                                    Nom de la salle <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" 
                                       value="{{ old('nom') }}" required placeholder="Ex: Salle 101, Laboratoire Physique...">
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Code -->
                            <div class="col-md-6">
                                <label for="code" class="form-label">
                                    Code <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" 
                                       value="{{ old('code') }}" required placeholder="Ex: S101, LAB_PHYS...">
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Type -->
                            <div class="col-md-6">
                                <label for="type" class="form-label">
                                    Type de salle <span class="text-danger">*</span>
                                </label>
                                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="normale" {{ old('type') === 'normale' ? 'selected' : '' }}>Salle normale</option>
                                    <option value="laboratoire" {{ old('type') === 'laboratoire' ? 'selected' : '' }}>Laboratoire</option>
                                    <option value="informatique" {{ old('type') === 'informatique' ? 'selected' : '' }}>Salle informatique</option>
                                    <option value="gymnase" {{ old('type') === 'gymnase' ? 'selected' : '' }}>Gymnase</option>
                                    <option value="autre" {{ old('type') === 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Capacité -->
                            <div class="col-md-6">
                                <label for="capacite" class="form-label">
                                    Capacité <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="capacite" id="capacite" class="form-control @error('capacite') is-invalid @enderror" 
                                       value="{{ old('capacite') }}" required min="1" max="200" placeholder="30">
                                @error('capacite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Localisation -->
                            <div class="col-md-12">
                                <label for="localisation" class="form-label">
                                    Localisation
                                </label>
                                <input type="text" name="localisation" id="localisation" class="form-control @error('localisation') is-invalid @enderror" 
                                       value="{{ old('localisation') }}" placeholder="Ex: Bâtiment A - RDC, 1er étage...">
                                @error('localisation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Équipements -->
                            <div class="col-md-12">
                                <label class="form-label">Équipements disponibles</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements[]" value="vidéoprojecteur" id="eq1">
                                            <label class="form-check-label" for="eq1">Vidéoprojecteur</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements[]" value="tableau_interactif" id="eq2">
                                            <label class="form-check-label" for="eq2">Tableau interactif</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements[]" value="ordinateur" id="eq3">
                                            <label class="form-check-label" for="eq3">Ordinateur</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements[]" value="climatisation" id="eq4">
                                            <label class="form-check-label" for="eq4">Climatisation</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements[]" value="laboratoire" id="eq5">
                                            <label class="form-check-label" for="eq5">Équipement de laboratoire</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements[]" value="wifi" id="eq6">
                                            <label class="form-check-label" for="eq6">WiFi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements[]" value="audio" id="eq7">
                                            <label class="form-check-label" for="eq7">Système audio</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipements[]" value="rangement" id="eq8">
                                            <label class="form-check-label" for="eq8">Espaces de rangement</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="col-md-12">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror" 
                                          placeholder="Informations complémentaires...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Disponible -->
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="disponible" id="disponible" 
                                           {{ old('disponible', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="disponible">
                                        Salle disponible pour utilisation
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>
                                        Créer la salle
                                    </button>
                                    <a href="{{ route('salles.index') }}" class="btn btn-secondary">
                                        Annuler
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
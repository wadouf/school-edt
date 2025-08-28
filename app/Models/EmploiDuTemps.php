<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class EmploiDuTemps extends Model
{
    use HasFactory, LogsActivity;

    /**
     * Nom de la table (corrigé pour correspondre à la migration)
     */
    protected $table = 'emplois_du_temps';

    protected $fillable = [
        'classe_id',
        'enseignant_id',
        'matiere_id',
        'salle_id',
        'creneau_horaire_id',
        'jour_semaine',
        'semaine_a',
        'semaine_b',
        'date_debut',
        'date_fin',
        'statut',
        'notes',
    ];

    protected $casts = [
        'semaine_a' => 'boolean',
        'semaine_b' => 'boolean',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'jour_semaine' => 'integer',
    ];

    /**
     * Configuration pour le logging des activités
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['classe_id', 'enseignant_id', 'matiere_id', 'salle_id', 'jour_semaine', 'statut'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relation avec la classe
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    /**
     * Relation avec l'enseignant
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    /**
     * Relation avec la matière
     */
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    /**
     * Relation avec la salle
     */
    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    /**
     * Relation avec le créneau horaire
     */
    public function creneauHoraire()
    {
        return $this->belongsTo(CreneauHoraire::class);
    }

    /**
     * Scope pour filtrer par jour de la semaine
     */
    public function scopeParJour($query, $jour)
    {
        return $query->where('jour_semaine', $jour);
    }

    /**
     * Scope pour filtrer par semaine A
     */
    public function scopeSemaineA($query)
    {
        return $query->where('semaine_a', true);
    }

    /**
     * Scope pour filtrer par semaine B
     */
    public function scopeSemaineB($query)
    {
        return $query->where('semaine_b', true);
    }

    /**
     * Scope pour les emplois actifs
     */
    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    /**
     * Obtenir le nom du jour de la semaine
     */
    public function getNomJourAttribute()
    {
        $jours = [
            1 => 'Lundi',
            2 => 'Mardi', 
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
            7 => 'Dimanche'
        ];

        return $jours[$this->jour_semaine] ?? 'Non défini';
    }
}
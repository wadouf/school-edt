<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Classe extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nom',
        'code',
        'niveau_id',
        'filiere_id',
        'section_id',
        'effectif',
        'capacite_max',
        'salle_principale',
        'professeur_principal',
        'actif',
        'notes',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    /**
     * Configuration pour le logging des activités
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nom', 'code', 'niveau_id', 'filiere_id', 'section_id', 'actif'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relation avec le niveau
     */
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    /**
     * Relation avec la filière
     */
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    /**
     * Relation avec la section linguistique
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Relation avec les emplois du temps
     */
    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    /**
     * Scope pour les classes actives
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Obtenir le nom complet de la classe avec section
     */
    public function getNomCompletAttribute()
    {
        return $this->nom . ' (' . $this->section->nom . ')';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Salle extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nom',
        'code',
        'type',
        'capacite',
        'localisation',
        'equipements',
        'disponible',
        'notes',
    ];

    protected $casts = [
        'equipements' => 'array',
        'disponible' => 'boolean',
    ];

    /**
     * Configuration pour le logging des activités
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nom', 'code', 'type', 'capacite', 'disponible'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relation avec les emplois du temps
     */
    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    /**
     * Scope pour les salles disponibles
     */
    public function scopeDisponible($query)
    {
        return $query->where('disponible', true);
    }

    /**
     * Scope par type de salle
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Vérifier si la salle peut accueillir un effectif donné
     */
    public function peutAccueillir($effectif)
    {
        return $this->capacite >= $effectif;
    }
}
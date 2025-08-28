<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CreneauHoraire extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'creneaux_horaires';

    protected $fillable = [
        'jour_semaine',
        'heure_debut',
        'heure_fin',
        'ordre',
        'est_pause',
        'nom',
        'actif',
    ];

    protected $casts = [
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
        'est_pause' => 'boolean',
        'actif' => 'boolean',
    ];

    /**
     * Configuration pour le logging des activités
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jour_semaine', 'heure_debut', 'heure_fin', 'nom', 'est_pause'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relation avec les emplois du temps
     */
    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class, 'creneau_horaire_id');
    }

    /**
     * Scope pour les créneaux actifs (non pause)
     */
    public function scopeNonPause($query)
    {
        return $query->where('est_pause', false);
    }

    /**
     * Scope pour les pauses
     */
    public function scopePause($query)
    {
        return $query->where('est_pause', true);
    }

    /**
     * Scope par jour
     */
    public function scopeJour($query, $jour)
    {
        return $query->where('jour_semaine', $jour);
    }

    /**
     * Scope pour ordonner par ordre
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre');
    }

    /**
     * Obtenir le libellé complet du créneau
     */
    public function getLibelleCompletAttribute()
    {
        return $this->nom . ' (' . $this->heure_debut->format('H:i') . ' - ' . $this->heure_fin->format('H:i') . ')';
    }
}
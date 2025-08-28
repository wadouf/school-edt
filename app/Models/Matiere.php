<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Matiere extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nom',
        'nom_en',
        'code',
        'couleur',
        'coefficient',
        'tp_requis',
        'type_salle',
        'description',
        'actif',
    ];

    protected $casts = [
        'tp_requis' => 'boolean',
        'actif' => 'boolean',
    ];

    /**
     * Configuration pour le logging des activités
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nom', 'code', 'couleur', 'tp_requis', 'actif'])
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
     * Scope pour les matières actives
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope pour les matières nécessitant des TP
     */
    public function scopeAvecTp($query)
    {
        return $query->where('tp_requis', true);
    }
}
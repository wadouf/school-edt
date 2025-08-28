<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Niveau extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'niveaux';

    protected $fillable = [
        'nom',
        'nom_en',
        'code',
        'ordre',
        'cycle',
        'actif',
        'description',
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
            ->logOnly(['nom', 'code', 'cycle', 'actif'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relation avec les classes
     */
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    /**
     * Scope pour les niveaux actifs
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope pour ordonner par ordre croissant
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre');
    }
}
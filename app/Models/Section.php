<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Section extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nom',
        'code',
        'langue',
        'description',
        'actif',
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
            ->logOnly(['nom', 'code', 'langue', 'actif'])
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
     * Scope pour les sections actives
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }
}
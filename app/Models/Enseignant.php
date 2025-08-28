<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Enseignant extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'type',
        'etablissement_attache',
        'heures_max_semaine',
        'matieres_enseignees',
        'sections_autorisees',
        'actif',
        'notes',
    ];

    protected $casts = [
        'matieres_enseignees' => 'array',
        'sections_autorisees' => 'array',
        'actif' => 'boolean',
    ];

    /**
     * Configuration pour le logging des activités
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nom', 'prenom', 'email', 'type', 'actif'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les emplois du temps
     */
    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    /**
     * Relation avec les disponibilités
     */
    public function disponibilites()
    {
        return $this->hasMany(DisponibiliteEnseignant::class);
    }

    /**
     * Obtenir les matières enseignées (relation via JSON - retourne une collection)
     */
    public function getMatieres()
    {
        if (!$this->matieres_enseignees) {
            return collect();
        }
        
        return Matiere::whereIn('id', $this->matieres_enseignees)->get();
    }

    /**
     * Accessor pour les matières (pour compatibilité avec les vues)
     */
    public function getMatieresAttribute()
    {
        return $this->getMatieres();
    }

    /**
     * Scope pour les enseignants actifs
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope pour les enseignants permanents
     */
    public function scopePermanent($query)
    {
        return $query->where('type', 'permanent');
    }

    /**
     * Scope pour les enseignants vacataires
     */
    public function scopeVacataire($query)
    {
        return $query->where('type', 'vacataire');
    }

    /**
     * Obtenir le nom complet
     */
    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Calculer les heures programmées dans la semaine
     */
    public function getHeuresProgrammeesAttribute()
    {
        return $this->emploisDuTemps()->count();
    }

    /**
     * Vérifier si l'enseignant peut enseigner une matière
     */
    public function peutEnseignerMatiere($matiere_id)
    {
        return in_array($matiere_id, $this->matieres_enseignees ?? []);
    }

    /**
     * Vérifier si l'enseignant peut enseigner dans une section
     */
    public function peutEnseignerSection($section_code)
    {
        // Si null, peut enseigner dans toutes les sections
        if (!$this->sections_autorisees) {
            return true;
        }
        
        return in_array($section_code, $this->sections_autorisees);
    }
}
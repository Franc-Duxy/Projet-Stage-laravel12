<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TacheRemplie extends Model
{
    protected $table = 'tache_remplie';
    protected $primaryKey = 'id';
    public $timestamps = false; // Désactiver les timestamps automatiques

    protected $fillable = [
        'id_projet',
        'id_tache',
        'id_utilisateur',
        'valeur_string',
        'valeur_texte',
        'valeur_entier',
        'valeur_date',
        'date_remplissage',
    ];

    protected $casts = [
        'valeur_string' => 'string',
        'valeur_texte' => 'string',
        'valeur_entier' => 'integer',
        'valeur_date' => 'date',
        'date_remplissage' => 'datetime',
    ];

    

    // Relations
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet', 'id_projet');
    }

    public function tache()
    {
        return $this->belongsTo(Tache::class, 'id_tache', 'id_tache');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    protected $table = 'etapes';
    protected $primaryKey = 'id_etape';

    protected $fillable = [
        'nom',
        'ordre',
    ];

    protected $casts = [
        'ordre' => 'integer',
    ];

    // Relations
    public function taches()
    {
        return $this->hasMany(Tache::class, 'id_etape', 'id_etape');
    }

    public function etapesProjets()
    {
        return $this->hasMany(EtapeProjet::class, 'id_etape', 'id_etape');
    }

    public function projets()
    {
        return $this->belongsToMany(Projet::class, 'etapes_projets', 'id_etape', 'id_projet')
                    ->withPivot('statut', 'date_debut', 'date_fin');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $table = 'projets';
    protected $primaryKey = 'id_projet';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'description',
        'date_debut',
        'statut',
    ];

    protected $casts = [
        'nom' => 'string',
        'description' => 'string',
        'date_debut' => 'date',
        'statut' => 'string',
    ];

    // Relations
    public function etapesProjets()
    {
        return $this->hasMany(EtapeProjet::class, 'id_projet', 'id_projet');
    }

    public function tachesRemplies()
    {
        return $this->hasMany(TacheRemplie::class, 'id_projet', 'id_projet');
    }

    public function etapes()
    {
        return $this->belongsToMany(Etape::class, 'etapes_projets', 'id_projet', 'id_etape')
                    ->withPivot('statut', 'date_debut', 'date_fin');
    }
}
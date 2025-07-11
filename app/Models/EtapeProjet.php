<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtapeProjet extends Model
{
    protected $table = 'etapes_projets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_projet',
        'id_etape',
        'statut',
        'date_debut',
        'date_fin',
    ];

    protected $casts = [
        'statut' => 'string',
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    // Relations
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet', 'id_projet');
    }

    public function etape()
    {
        return $this->belongsTo(Etape::class, 'id_etape', 'id_etape');
    }
}

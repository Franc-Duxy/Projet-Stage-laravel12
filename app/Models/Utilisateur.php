<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'role',
    ];

    protected $casts = [
        'nom' => 'string',
        'prenom' => 'string',
        'email' => 'string',
        'mot_de_passe' => 'string',
        'role' => 'string',
        'created_at' => 'datetime',
    ];

    // Relations
    public function tachesRemplies()
    {
        return $this->hasMany(TacheRemplie::class, 'id_utilisateur', 'id');
    }
}

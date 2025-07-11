<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'taches';
    protected $primaryKey = 'id_tache';
    public $timestamps = false; // Désactiver les timestamps, car ils ne sont pas dans le schéma SQL
    protected $fillable = [
        'nom',
        'id_etape',
        'type_valeur',
        'ordre',
    ];

    protected $casts = [
        'type_valeur' => 'string',
        'ordre' => 'integer',
    ];

    // Validation des valeurs possibles pour type_valeur
    public function setTypeValeurAttribute($value)
    {
        $allowedValues = ['int', 'string', 'date', 'text'];
        if (!in_array($value, $allowedValues)) {
            throw new \InvalidArgumentException("Le type_valeur doit être l'un des suivants : " . implode(', ', $allowedValues));
        }
        $this->attributes['type_valeur'] = $value;
    }

    // Relations
    public function etape()
    {
        return $this->belongsTo(Etape::class, 'id_etape', 'id_etape');
    }

    public function tachesRemplies()
    {
        return $this->hasMany(TacheRemplie::class, 'id_tache', 'id_tache');
    }
}

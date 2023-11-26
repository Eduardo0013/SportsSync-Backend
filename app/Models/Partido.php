<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Torneo;
use App\Models\Resultado;

class Partido extends Model
{
    use HasFactory;

    /**
    * Relación uno a muchos con Torneo
    */
    public function torneo(){
        return $this->belongsTo(Torneo::class);
    }
    /**
    * Relación uno a muchos Resultado
    */
    public function resultados() {
        return $this->hasMany(Resultado::class);
    }
}

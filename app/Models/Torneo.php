<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;
use App\Models\Partido;
use App\Models\Categoria;

class Torneo extends Model
{
    use HasFactory;
    
    /**
    * Relación muchos a muchos con equipo
    */
    public function equipos(){
        return $this->belongsToMany(Equipo::class,'equipos_torneos');
    }
    /**
    * Relación uno a muchos con categoria
    */
    public function categorias(){
        return $this->belongsTo(Categoria::class);
    }
    /**
    * Relación uno a muchos con Partido
    */
    public function partidos(){
        return $this->hasMany(Partido::class);
    }
}

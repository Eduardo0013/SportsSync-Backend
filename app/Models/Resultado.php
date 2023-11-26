<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;
use App\Models\Partido;

class Resultado extends Model
{
    use HasFactory;
    
    /**
    * Relación uno a muchos con Equipo
    */
    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }
    /**
    * Relación uno a muchos con Partido
    */
    public function partido(){
        return $this->hasOne(Partido::class);
    }
}

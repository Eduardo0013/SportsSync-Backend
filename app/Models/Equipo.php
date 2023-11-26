<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Deporte;
use App\Models\Resultado;
use App\Models\Torneos;

class Equipo extends Model
{
    use HasFactory;
    protected $hidden = [
        'id'
    ];
    protected $guarded = [
        'id'
    ];
    /**
    * Relación muchos a muchos con user
    */
    public function users(){
        return $this->belongsTo(User::class);
    }
    /**
    *  Relación uno a muchos con deporte
    */
    public function deporte() {
        return $this->hasOne(Deporte::class);
    }
    /**
    * Relación uno a muchos con resultado
    */
    public function resultados() {
        return $this->hasMany(Resultado::class);
    }
    /**
    * Relación muchos a muchos con torneos
    */
    public function torneos(){
        return $this->belongsToMany(Torneos::class);
    }
    /**
    * Relación uno a muchos con invitaciones
    */
    public function invitaciones() {
        return $this->hasMany(Invitacion::class);
    }
}

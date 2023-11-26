<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Torneo;

class Invitacion extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $table = "invitaciones";
    /**
    * Relación 1 a muchos con equipo
    */
    public function equipos(){
        return $this->belongsTo(Equipo::class);
    }
    /**
    *   Relación uno a muchos con users
    */
    public function users(){
        return $this->belongsTo(User::class);
    }
    /**
    *  Relación uno a muchos con torneo
    */
    public function torneo() {
        return $this->belongsTo(Torneo::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;

class Deporte extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    /**
    * relación uno a muchos con equipos
    */
    public function equipos(){
        return $this->belongsToMany(Equipo::class);
    }
}

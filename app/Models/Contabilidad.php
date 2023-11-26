<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Torneo;

class Contabilidad extends Model
{
    use HasFactory;
    protected $table = "contabilidad";

    /**
    * Relación uno a muchos con Torneo
    */
    public function torneo(){
        return $this->belongsTo(Torneo::class);
    }
}

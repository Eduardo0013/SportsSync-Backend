<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    /**
    * Relación uno a muchos con torneo
    */
    public function torneo(){
        return $this->hasOne(Torneo::class);
    }
}

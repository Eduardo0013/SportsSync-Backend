<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = "roles";
    
    /**
     * Relación uno a muchos
     */
    public function permisos(){
        return $this->belongsToMany('App\Models\Permiso','roles_permisos');
    }
}

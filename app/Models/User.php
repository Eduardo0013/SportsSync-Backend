<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticable implements JWTSubject
{
    use HasFactory,Notifiable;
    protected $hidden = [
        'password'
    ];
    protected $guarded = [
        'id'
    ];
    public function attributtes(){
        return new CastsAttribute(
            set: fn($value) => Hash::make($value)
        );
    }
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
    /**
    * Relación uno a muchos con PersonalAccessToken
    */
    public function personalTokenAccess(){
        return $this->hasMany(PersonalAccessToken::class);
    }
    /**
    * Relación muchos a muchos con Roles
    */
    public function roles(){
        return $this->belongsToMany(Roles::class,'users_roles');
    }
    /**
    * Relación muchos a muchos con Equipo
    */
    public function equipos(){
        return $this->belongsToMany(Equipo::class,'users_equipos');
    }
}

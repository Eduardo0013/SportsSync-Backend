<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $hidden = [
        'id'
    ];
    
    /**
     * Relación uno a muchos
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}

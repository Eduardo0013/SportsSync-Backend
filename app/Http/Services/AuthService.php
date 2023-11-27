<?php
namespace App\Http\Services;

use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService{
    public function create(Collection $user) {
        $user = User::create([
            'nombre' => $user->get('nombre'),
            'username' => $user->get('username'),
            'apellido_paterno' => $user->get('apellidoPaterno'),
            'apellido_materno' => $user->get('apellidoMaterno'),
            'phone_number' => $user->get('phoneNumber'),
            'fecha_nacimiento' => $user->get('fechaNacimiento'),
            'profile_photo' => $user->get('profilePhoto'),
            'ine_address' => $user->get('ineAddress'),
            'password' => Hash::make($user->get('password')),
            'email' => $user->get('email')
        ]);
    
        $expiresAt = now()->addDays(25);
        $token = JWTAuth::fromUser($user,['expires' => $expiresAt]);
        $personalAccessToken = PersonalAccessToken::create([
            'access_token' => $token,
            'user_id' => $user->id,
            'expired_at' => $expiresAt
        ]);
        if($user === null || $personalAccessToken === null){
            return collect();
        }
    
        return collect([
            'user' => $user,
            'bearerToken' => $personalAccessToken->access_token
        ]);
    }
    public function login(Collection $user) {
        $userReal = User::where('username',$user->get('username'))->first();    
   
        if($userReal === null) {
            throw new HttpResponseException(response()->json([
                'message' => 'No autorizado, usuario no encontrado'
            ],404));
        }
        $expireAt = now()->addDays(25);
        $token = PersonalAccessToken::create([
            'user_id' => $userReal->id,
            'access_token' => JWTAuth::fromUser($userReal),
            'expired_at' => $expireAt
        ]);
        if(!Hash::check($user->get('password'),$userReal->password)){
            return false;
        }
        return collect([
          'message' => 'Acceso correcto',
          'bearerToken' => $token->access_token  
        ]);
    }
    public function update(Collection $user) {
        $user = User::find($user->id)->get();
        if($user === null){
            return false;
        }
        $user->nombre = $user->get('nombre');
        $user->username = $user->get('username');
        $user->apellido_paterno = $user->get('apellidoPaterno');
        $user->apellido_materno = $user->get('apellidoMaterno');
        $user->phone_number = $user->get('phoneNumber');
        $user->fecha_nacimiento = $user->get('fechaNacimiento');
        $user->profile_photo = $user->get('profilePhoto');
        $user->ine_address = $user->get('ineAddress');
        $user->password = Hash::make($user->get('password'));
        $user->email = $user->get('email');
        return $user->save();
    }
}
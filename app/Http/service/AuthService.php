<?php
namespace App\Http\Service;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\LoginRequest;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService{
    public function create(CreateRequest $request) {
        $user = User::create([
            'nombre' => $request->nombre,
            'username' => $request->username,
            'apellido_paterno' => $request->apellidoPaterno,
            'apellido_materno' => $request->apellidoMaterno,
            'phone_number' => $request->phoneNumber,
            'fecha_nacimiento' => $request->fechaNacimiento,
            'profile_photo' => $request->profilePhoto,
            'ine_address' => $request->ineAddress,
            'password' => Hash::make($request->password),
            'email' => $request->email
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
    public function login(LoginRequest $user) {
        $userReal = User::where('username',$user->username)->firstOrFail();        
        $expireAt = now()->addDays(25);
        $token = PersonalAccessToken::create([
            'user_id' => $userReal->id,
            'access_token' => JWTAuth::fromUser($userReal),
            'expired_at' => $expireAt
        ]);
        if(!Hash::check($user->password,$userReal->password)){
            return false;
        }
        return collect([
          'user' => $user,
          'bearerToken' => $token->access_token  
        ]);
    }
}
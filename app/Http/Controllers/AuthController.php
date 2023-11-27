<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUpdateRequest;
use App\Http\Requests\CreateRequest;
use App\Http\Services\AuthService;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {
        $this->middleware('auth:api',['except' => ['login','create']]);
    }
    public function login(LoginRequest $request) {
       if($content = $this->authService->login(collect($request->all()))){
            return response()->json($content->toArray(),200);
       }
        return response()->json([
            'message' => 'No authorizado, credenciales incorrectas'
        ],401);
    }
    //
    public function create(CreateRequest $request) {
        $content = $this->authService->create(collect($request->all()));
        if($content->isNotEmpty()) {
            return response()->json($content->toArray(),201);
        }
        
        return response()->json([
            'message' => 'no se recibieron datos'
        ],400);
    }
    public function update(AuthUpdateRequest $request) {
        if($this->authService->update(collect($request->all()))){
            return response()->json([
                'message' => 'El recurso ha sido actualizado',
            ],200);
        }
        return response()->json([
            'message' => 'No se ha podido actualizar el recurso'
        ],400);
    }
}

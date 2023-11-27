<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipoCreateRequest;
use App\Models\Equipo;

class EquipoController extends Controller
{
    public function index(){
        return response()->json(Equipo::all());
    }
    //
    public function store(EquipoCreateRequest $equipoCreateRequest) {
        $equipo = Equipo::create($equipoCreateRequest->all());
        if($equipo !== null){
            return response()->json([
                'message' => 'El recurso ha sido creado',
                'equipo' => $equipo
            ],201);
        }
        abort(404,'No ha sido posible crear el recurso');
    }
}

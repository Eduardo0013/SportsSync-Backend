<?php

namespace App\Http\Controllers;

use App\Http\Service\TorneoService;
use App\Models\Torneo;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    public function __construct(private TorneoService $torneoService) {
        $this->middleware('auth:api',['except' => ['show']]);
    }
    //
    public function store(Request $request){
        $collect = $this->torneoService->create($request);
        if($collect->isNotEmpty()){
            return response()->json([
                'message' => 'El recurso ha sido creado',
                'torneo' => $collect->get('torneo'),
                'invitados' => $collect->get('invitados')
            ],201);
        }
        return response()->json([
            'message' => 'No se ha podido crear el recurso'
        ],404);
    }
    public function show(int $id) {
        $torneo = Torneo::find($id)->get();
        if(!$torneo->isEmpty()){
            return response()->json([
                'torneo' => $torneo
            ],200);
        }
        return response()->json([
            'message' => 'No se han encontrado resultados'
        ],404);
    }
}

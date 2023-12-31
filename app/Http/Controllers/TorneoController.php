<?php

namespace App\Http\Controllers;

use App\Http\Requests\TorneoCreateRequest;
use App\Http\Services\TorneoService;
use App\Models\Torneo;

class TorneoController extends Controller
{
    public function __construct(private TorneoService $torneoService) {
        $this->middleware('auth:api',['except' => ['show','index']]);
    }
    public function index(){
        return response()->json([
            'torneos' => Torneo::all()
        ],200);
    }
    //
    public function store(TorneoCreateRequest $request){
        $collect = $this->torneoService->create(collect($request->all()));
        if($collect->isNotEmpty()){
            return response()->json(array_merge([
                'message' => 'El recurso ha sido creado',    
            ],$collect->toArray()),201);
        }
        return response()->json([
            'message' => 'No se ha podido crear el recurso'
        ],404);
    }
    public function show(int $id) {
        $torneo = Torneo::where('id',$id)->first();
        if($torneo !== null){
            return response()->json([
                'torneo' => $torneo
            ],200);
        }
        return response()->json([
            'message' => 'No se han encontrado resultados'
        ],404);
    }
}

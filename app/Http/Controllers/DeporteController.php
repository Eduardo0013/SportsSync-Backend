<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeporteStoreRequest;
use App\Http\Services\DeporteService;
use App\Http\Requests\DeporteUpdateRequest;
use App\Models\Deporte;

class DeporteController extends Controller
{
    public function __construct(private DeporteService $deporteService) {
        $this->middleware('auth:api',['except' => ['show','index']]);
    }
    public function index(){
        return response()->json([
            'deportes' => Deporte::all()
        ],200);
    }
    //
    public function store(DeporteStoreRequest $request){
        if(($deporte = Deporte::create($request->all())) != null){
            return response()->json([
                'deporte' => $deporte,
                'message' => 'El recurso fue creado'
            ],201);
        }
        return response()->json([
            'message' => 'No se ha podido crear el recurso'
        ],401);
    }
    /**
    * 
    */
    public function show($id){
        $deporte = Deporte::where('id',$id)->first();
        
        if($deporte !== null){
            return response()->json([
                'deporte' => $deporte
            ],200);
        }
        return response()->json([
            'message' => 'No se encontraron resultados'
        ],401);
    }
    public function update(DeporteUpdateRequest $request) {
        if($this->deporteService->update(collect($request->all()))){
            return response()->json([
                'message' => 'El recurso fue actualizado'
            ],200);
        }
        return response()->json([
            'message' => 'No se ha podido actualizar el recurso'
        ]);
    }
}

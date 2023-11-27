<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequestCreate;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index(){
        return response()->json([
            'categorias' => Categoria::all()
        ],200);
    }
    //
    public function show($id) {
        $categoria = Categoria::find($id)->get();
        if($categoria->isEmpty()){
            return response()->json([
                'message' => 'No se encontraron resultados'
            ],404);
        }
        return response()->json([
            'categoria' => $categoria,
        ],200);
    }
    public function store(CategoriaRequestCreate $request) {
        $categoria = Categoria::create($request->all());
        if($categoria !== null){
            return response()->json([
                'categoria' => $categoria,
                'message' => 'El recurso ha sido creado'
            ],201);
        }
        return response()->json([
            'message' => 'No se ha podido crear el recurso'
        ],401);
    }
}

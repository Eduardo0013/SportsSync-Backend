<?php

namespace App\Http\Controllers;

use App\Models\Deporte;
use Illuminate\Http\Request;

class DeporteController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
        ]);
        Deporte::create($request->all());
    }
}

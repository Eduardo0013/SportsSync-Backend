<?php
namespace App\Http\Service;

use App\Http\Requests\DeporteStoreRequest;
use App\Http\Requests\DeporteUpdateRequest;
use App\Models\Deporte;

class DeporteService{
    public function create(DeporteStoreRequest $deporteStoreRequest) {
        return $deporte = Deporte::create($deporteStoreRequest->all());
    }
    public function update(DeporteUpdateRequest $deporteStoreRequest): bool {
        $deporte = Deporte::find($deporteStoreRequest->id)->get();
        if($deporte === null){
            return false;
        }
        $deporte->nombre = $deporteStoreRequest->nombre;
        return $deporte->save();
    }
}
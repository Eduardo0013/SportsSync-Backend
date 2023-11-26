<?php
namespace App\Http\Service;

use App\Models\Deporte;
use Illuminate\Support\Collection;

class DeporteService{
    public function create(Collection $deporte) {
        return Deporte::create($deporte->all());
    }
    public function update(Collection $deporte) : bool {
        $deporte = Deporte::find($deporte->get('id'))->get();
        if($deporte === null){
            return false;
        }
        $deporte->nombre = $deporte->get('nombre');
        return $deporte->save();
    }
}
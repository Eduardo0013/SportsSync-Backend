<?php
namespace App\Http\Service;

use App\Models\Torneo;
use Illuminate\Http\Request;
use RuntimeException;

class TorneoService {
    
    public function create(Request $torneo) {
        $torneoEntity = new Torneo();
        $torneoEntity->nombre = $torneo->nombre;
        $torneoEntity->descripcion = $torneo->descripcion;
        $torneoEntity->logo_img = $torneo->logoImg;
        $torneoEntity->fecha_inicio = $torneo->fechaInicio;
        $torneoEntity->fecha_fin = $torneo->fechaFin;
        $torneoEntity->ubicacion = $torneo->ubicacion;
        $torneoEntity->categoria_id = $torneo->categoria;
        $torneoEntity->deporte_id = $torneo->deporte;
        $torneoEntity->privado = $torneo->privado;

        $torneoEntity->save();
        if(!$torneoEntity){
            throw new RuntimeException('Se ha producido un error');
        }
        $invitados = $torneo->collect('invitados');
        $torneoEntity->equipos()->attach($invitados->toArray());
        return collect([
            'torneo' => $torneoEntity,
            'invitados' => $invitados
        ]);
    }
}
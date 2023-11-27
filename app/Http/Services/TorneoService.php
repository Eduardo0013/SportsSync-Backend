<?php
namespace App\Http\Services;

use App\Models\Torneo;
use DateTime;
use Illuminate\Support\Collection;
use RuntimeException;

class TorneoService {
    
    public function create(Collection $torneo) {
        $torneoEntity = new Torneo();
        $torneoEntity->nombre = $torneo->get('nombre');
        $torneoEntity->descripcion = $torneo->get('descripcion');
        $torneoEntity->logo_img = $torneo->get('logoImg');
        $torneoEntity->fecha_inicio = $torneo->get('fechaInicio');
        $torneoEntity->fecha_fin = $torneo->get('fechaFin');
        $torneoEntity->ubicacion = $torneo->get('ubicacion');
        $torneoEntity->categoria_id = $torneo->get('categoria');
        $torneoEntity->deporte_id = $torneo->get('deporte');
        $torneoEntity->privado = $torneo->get('privado');

        if(!$torneoEntity->save()){
            throw new RuntimeException('Se ha producido un error');
        }
        if(!empty($invitados = $torneo->get('invitados'))){
            /*$fechaInicio = new DateTime($torneoEntity->fechaInicio);
            $fechaFin = new DateTime($torneoEntity->fechaFin);
            $diferencia = $fechaInicio->diff($fechaFin);
            $diferencia = (int) $diferencia->format('%R%a');
            $expiresAt = $diferencia > 2 ? now()->addDays(2) : now()->addHours(5);*/
            $torneoEntity->invitaciones()->createMany($invitados);
            return collect([
                'torneo' => $torneoEntity,
                'invitados' => $invitados
            ]);
        }
        return collect([
            'torneo' => $torneoEntity
        ]);
    }
}
<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Arboles;
use Validator;

class ParqueJardin extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'parque_jardin';
    public $timestamps = false;
    protected $fillable = [
        'folio',
        'fecha',
        'name_solicitante',
        'tel',
        'domicilio',
        'calle1',
        'calle2',
        'poda',
        'tala',
        'otro',
        'observacion_servicio',
        'fecha_inspeccion',
        'observacion_inspeccion',
        'name_inspector',
        'procede',
        'procedeText',
        'fecha_valoracion',
        'observacion_valoracion',
        'name_valoracion',
        'id_user',
        'fecha_alta',
        'user_update',
        'fecha_update',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public static function new($data) {
        $new = ParqueJardin::create([
            'folio' => $data['folio'],
            'fecha' => $data['fecha'],
            'name_solicitante' => $data['name_solicitante'],
            'tel' => $data['tel'],
            'domicilio' => $data['domicilio'],
            'calle1' => $data['calle1'],
            'calle2' => $data['calle2'],
            'poda' => $data['poda'],
            'tala' => $data['tala'],
            'otro' => $data['otro'],
            'observacion_servicio' => $data['observacion_servicio'],
            'fecha_inspeccion' => $data['fecha_inspeccion'],
            'observacion_inspeccion' => $data['observacion_inspeccion'],
            'name_inspector' => $data['name_inspector'],
            'procede' => @$data['procede'] ? 1 : 0,
            'procedeText' => $data['procedeText'],
            'fecha_valoracion' => $data['fecha_valoracion'],
            'observacion_valoracion' => $data['observacion_valoracion'],
            'name_valoracion' => $data['name_valoracion'],
            'id_user' => \Auth::User()->id,
            'fecha_alta' => date('Y-m-d H:i:s'),
        ]);
        if($new){
            foreach ($data['inspeccionEspecie'] as $key => $dat) {
                $newRegister = Arboles::new( ['id' => $new->id, 'especie' => $data['inspeccionEspecie'][$key], 'altura' => $data['inspeccionAltura'][$key], 'diametro_tronco' => $data['inspeccionDiametro'][$key], 'accion' => 1 ] );
                if ( !$newRegister ) {
                    Arboles::where( 'id_parque_jardin', $new->id )->delete();
                    ParqueJardin::where( 'id', $new->id )->delete();
                    return false;
                }
            }
            foreach ($data['restitucionEspecie'] as $key => $dat) {
                $newRegister = Arboles::new( ['id' => $new->id, 'especie' => $data['restitucionEspecie'][$key], 'altura' => $data['restitucionAltura'][$key], 'diametro_tronco' => $data['restitucionDiametro'][$key], 'accion' => 2 ] );
                if ( !$newRegister ) {
                    Arboles::where( 'id_parque_jardin', $new->id )->delete();
                    ParqueJardin::where( 'id', $new->id )->delete();
                    return false;
                }
            }
        }
        return $new;
    }

    public static function editar($data) {
        $registro = ParqueJardin::find($data['id']);
        $registro->fecha = $data['fecha'];
        $registro->name_solicitante = $data['name_solicitante'];
        $registro->tel = $data['tel'];
        $registro->domicilio = $data['domicilio'];
        $registro->calle1 = $data['calle1'];
        $registro->calle2 = $data['calle2'];
        $registro->poda = $data['poda'];
        $registro->tala = $data['tala'];
        $registro->otro = $data['otro'];
        $registro->observacion_servicio = $data['observacion_servicio'];
        $registro->fecha_inspeccion = $data['fecha_inspeccion'];
        $registro->observacion_inspeccion = $data['observacion_inspeccion'];
        $registro->name_inspector = $data['name_inspector'];
        $registro->procede = @$data['procede'] ? 1 : 0;
        $registro->procedeText = $data['procedeText'];
        $registro->fecha_valoracion = $data['fecha_valoracion'];
        $registro->observacion_valoracion = $data['observacion_valoracion'];
        $registro->name_valoracion = $data['name_valoracion'];
        $registro->user_update = \Auth::User()->id;
        $registro->fecha_update=date('Y-m-d H:i:s');
        Arboles::where( 'id_parque_jardin', $data['id'] )->delete();
        foreach ($data['inspeccionEspecie'] as $key => $dat) {
            $newRegister = Arboles::new( ['id' => $data['id'], 'especie' => $data['inspeccionEspecie'][$key], 'altura' => $data['inspeccionAltura'][$key], 'diametro_tronco' => $data['inspeccionDiametro'][$key], 'accion' => 1 ] );
        }
        foreach ($data['restitucionEspecie'] as $key => $dat) {
            $newRegister = Arboles::new( ['id' => $data['id'], 'especie' => $data['restitucionEspecie'][$key], 'altura' => $data['restitucionAltura'][$key], 'diametro_tronco' => $data['restitucionDiametro'][$key], 'accion' => 2 ] );
        }
        return $registro->save();
    }
}
<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class EventosActividades extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'eventos_actividades';
    public $timestamps = false;
    protected $fillable = [
        'id_evento',
        'hora_inicio',
        'hora_fin',
        'actividad',
        'observaciones',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return EventosActividades::create([
                'id_evento' => $data['id_evento'],
                'hora_inicio' => $data['hora_inicio'],
                'hora_fin' => $data['hora_fin'],
                'actividad' => $data['actividad'],
                'observaciones' => $data['observaciones']
            ]);
    }

    public static function editaRegistro($data) {
        $registro= Eventos::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->descripcion=$data['descripcion'];
        $registro->estatus=2;
        $registro->fecha_edit=date('Y-m-d H:i:s');
        $registro->save();
        return true;
    }


}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class EventosReporte extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'eventos_reporte';
    public $timestamps = false;
    protected $fillable = [
        'id_evento',
        'id_usuario',
        'anexo',
        'tipo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return EventosReporte::create([
                'id_evento' => $data['id_evento'],
                'id_usuario' => \Auth::User()->id,
                'anexo' => $data['anexo'],
                'tipo' => $data['tipo']
            ]);
    }

    public static function editaRegistro($data) {
        $registro= EventosReporte::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->descripcion=$data['descripcion'];
        $registro->estatus=2;
        $registro->fecha_edit=date('Y-m-d H:i:s');
        $registro->save();
        return true;
    }


}

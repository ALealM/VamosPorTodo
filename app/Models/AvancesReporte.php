<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class AvancesReporte extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'avances_reporte';
    public $timestamps = false;
    protected $fillable = [
        'id_reporte',
        'id_usuario',
        'fecha_alta',
        'fecha',
        'accion',
        'actividad',
        'avance',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return AvancesReporte::create([
                'id_reporte' => $data['id_reporte'],
                'id_usuario' => \Auth::User()->id,
                'fecha_alta' => date('Y-m-d H:i:s'),
                'fecha' => $data['fecha'],
                'accion' => 'SEGUIMIENTO',
                'actividad' => $data['actividad'],
                'avance' => $data['avance'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= AvancesReporte::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->descripcion=$data['descripcion'];
        $registro->estatus=2;
        $registro->fecha_edit=date('Y-m-d H:i:s');
        $registro->save();
        return true;
    }
    
    public function reporte() {
        return $this->belongsTo('App\Models\Reportes','id_reporte','id')->first();
    }
}
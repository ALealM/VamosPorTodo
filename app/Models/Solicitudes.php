<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Solicitudes extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'solicitudes';
    public $timestamps = false;
    protected $fillable = [
        'asunto',
        'id_usuario',
        'id_tipo',
        'descripcion',
        'ubicacion',
        'fecha_alta',
        'id_colonia',
        'id_programa',
        'semaforo',
        'id_direccion',
        'fecha_inicio',
        'fecha_proceso',
        'fecha_termino',
        'aprobacion',
        'fecha_aprobacion',
        'day',
        'hora',
        'lugar',
        'no_asistentes',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return Solicitudes::create([
                'asunto' => $data['asunto'],
                'id_usuario' => \Auth::User()->id,
                'id_tipo' => $data['id_tipo'],
                'descripcion' => $data['descripcion'],
                'ubicacion' => $data['ubicacion'],
                'fecha_alta' => date('Y-m-d H:i:s'),
                'id_colonia' => $data['id_colonia'],
                'id_programa' => $data['id_programa'],
                'semaforo' => $data['semaforo'],
                'id_direccion' => $data['id_direccion'],
                'day' => $data['day'],
                'hora' => $data['hora'],
                'lugar' => $data['lugar'],
                'no_asistentes' => $data['no_asistentes'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= Solicitudes::find($data['id']);
        $registro->asunto=$data['asunto'];
        $registro->id_tipo=$data['id_tipo'];
        $registro->descripcion=$data['descripcion'];
        $registro->ubicacion=$data['ubicacion'];
        $registro->id_colonia=$data['id_colonia'];
        $registro->id_programa=$data['id_programa'];
        $registro->semaforo=$data['semaforo'];
        $registro->id_direccion=$data['id_direccion'];
        $registro->day = $data['day'];
        $registro->hora = $data['hora'];
        $registro->lugar = $data['lugar'];
        $registro->no_asistentes = $data['no_asistentes'];
        switch ( $data['semaforo'] ) {
            case 1: // 'Iniciado'
                $registro->fecha_inicio = date('Y-m-d H:i:s');
                break;
            case 2: // 'En Proceso'
                $registro->fecha_proceso = date('Y-m-d H:i:s');
                break;
            case 3: // 'Concluido'
                $registro->fecha_termino = date('Y-m-d H:i:s');
                break;
        }
        $registro->save();
        return true;
    }

    public function colonia(){
        return $this->belongsTo('App\Models\ColoniasB','id_colonia','id')->first();
    }
        
    public function estatus(){
        $estatus = [0=>'Reportado',1=>'Iniciado',2=>'En Proceso',3=>'Concluido'];
        return $estatus[$this->attributes['semaforo']];
    }
    
    public function user(){
        return $this->belongsTo('App\User','id_usuario','id')->first();
    }

    public function programa(){
        return $this->belongsTo('App\Models\Programas','id_programa','id')->first();
    }
    
    public function rubro(){
        return $this->belongsTo('App\Models\Rubros','id_tipo','id')->first();
    }
    
    public function responsable(){
        return $this->belongsTo('App\Models\Gabinete','id_direccion','id')->first();
    }
}
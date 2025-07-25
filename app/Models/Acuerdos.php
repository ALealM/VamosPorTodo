<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Acuerdos extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'acuerdos';
    public $timestamps = false;
    protected $fillable = [
        'id_usuario',
        'acuerdo',
        'archivo',
        'id_dependencia',
        'estatus',
        'fecha_solicitada',
        'fecha_alta',
        'temas',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return Acuerdos::create([
                'id_usuario' => \Auth::User()->id,
                'acuerdo' => $data['acuerdo'],
                'temas' => isset($data['temas']) ? $data['temas'] : null,
                'id_dependencia' => $data['id_dependencia'],
                'estatus' => 0,
                'fecha_solicitada' => $data['fecha_solicitada'],
                'fecha_alta' => date('Y-m-d H:i:s'),
            ]);
    }

    public static function editaRegistro($data) {
        $registro= Acuerdos::find($data['id']);
        $registro->acuerdo=$data['acuerdo'];
        $registro->fecha_solicitada=$data['fecha_solicitada'];
        $registro->save();
        return true;
    }
    
    public static function editalistadoRegistro($data) {
        $registro= Acuerdos::find($data['id']);
        $registro->estatus=$data['estatus'];
        if($data['estatus']==5){        
                $data['fecha_otorgada']=null;
                $data['hora_otorgada']=null;
                $registro->fecha_otorgada=$data['fecha_otorgada'];
                $registro->hora_otorgada=$data['hora_otorgada'];
        }else{
        $registro->fecha_otorgada=$data['fecha_otorgada'];
        $registro->hora_otorgada=$data['hora_otorgada'];
        }
        $registro->save();
        return true;
    }

    public function dependencia(){
        return $this->belongsTo('App\Models\Dependencias','id_dependencia','id')->first();
    }
    
    public function nombreCompleto () {
        return $this->attributes['nombre']." ".$this->attributes['ap_paterno']." ".$this->attributes['ap_materno'];
    }
    
    public function usuario(){
        return $this->belongsTo('App\User','id_usuario','id')->first();
    }
    
    /*public function actividad(){
        return $this->belongsTo('App\Models\AcuerdosActividades','id_acuerdo','id')->first();
    }*/
   

    /*public function status(){
        $estatus = [0 =>'Sin iniciar', 1 =>'En proceso', 2 =>'Finalizado', 3 =>'Enviado',4 =>'Autorizado', 5 =>'No autorizado'];
        return $estatus[$this->attributes['estatus']];
    }*/
    
    public function status(){
        $estatus = [0 =>'Enviado', 4 =>'Autorizado', 5 =>'No autorizado'];
        return $estatus[$this->attributes['estatus']];
    }
    
    
    public function statusreunion(){
        $estatus = [4 =>'Autorizado', 5 =>'No autorizado'];
        return $estatus[$this->attributes['estatus']];
    }
    
}

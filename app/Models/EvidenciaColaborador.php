<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;
    
class EvidenciaColaborador extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'evidencia_colaborador';
    public $timestamps = false;
    protected $fillable = [
        'id_usuario',
        'id_acuerdo',
        'id_actividad',
        'id_colaborador',
        'archivo',
        'reporte',
        'fecha_alta',
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return EvidenciaColaborador::create([
                'id_usuario' => \Auth::User()->id,
                'id_acuerdo' => $data['id_acuerdo'],
                'id_actividad' => $data['id'],
                'id_colaborador' => $data['id_colaborador'],
                'archivo' => $data['archivo'],
                'reporte' => $data['reporte'],
                'fecha_alta' => date('Y-m-d H:i:s'),
                
            ]);
    }

    
    public static function editaRegistro($data) {
        $id_usuario=\Auth::User()->id;
        $avance= EvidenciaColaborador::find($data['id']);
        $avance->id_usuario=$id_usuario;
        $avance->id_acuerdo=$data['id_acuerdo'];
        $avance->id_actividad=$data['id_responsable'];
        $avance->id_colaborador=$data['id_dependencia'];
        $avance->archivo=$data['archivo'];
        $avance->reporte=$data['reporte'];
        $avance->fecha_alta=$data[date('Y-m-d H:i:s')];
        $avance->save();
        return true;
    }
    

    public function dependencia(){
        return $this->belongsTo('App\Models\Dependencias','id_dependencia','id')->first();
    }
    
    public function acuerdos(){
        return $this->belongsTo('App\Models\Acuerdos','id_acuerdos','id')->first();
    }
    
    
    public function nombreCompleto () {
        return $this->attributes['nombre']." ".$this->attributes['ap_paterno']." ".$this->attributes['ap_materno'];
    }
    
    public function usuario(){
        return $this->belongsTo('App\User','id_usuario','id')->first();
    }
    
    /*
    public function imagenes(){
        return InformeAnexos::where('id_informe',$this->attributes['id'])->where('tipo',1)->get();
    }
    
    public function documentos(){
        return InformeAnexos::where('id_informe',$this->attributes['id'])->where('tipo',2)->get();
    }*/

}

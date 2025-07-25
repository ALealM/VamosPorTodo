<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;
    
class EvidenciaResponsable extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'evidencia_responsable';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_responsable',
        'id_acuerdo',
        'id_actividad',
        'avance',
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
            return EvidenciaResponsable::create([
                'id_responsable' => $data['id_responsable'],
                'id_acuerdo' => $data['id_acuerdo'],
                'id_actividad' => $data['id'],
                'avance' => $data['avance'],
                'archivo' => $data['archivo'],
                'reporte' => $data['reporte'],
                'fecha_alta' => date('Y-m-d H:i:s'),
                
            ]);
    }

    
    public static function editaRegistro($data) {
        $avance= EvidenciaResponsable::find($data['id']);
        $avance->id_responsable=$data['id_responsable'];
        $avance->id_acuerdo=$data['id_acuerdo'];
        $avance->id_actividad=$data['id_responsable'];
        $avance->avance=$data['avance'];
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
    

}

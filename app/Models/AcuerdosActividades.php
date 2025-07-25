<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class AcuerdosActividades extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'acuerdos_actividades';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_acuerdo',
        'actividad',
        'fecha',
        'id_responsable',
        'avance',
        'reporte',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return AcuerdosActividades::create([
                'id_acuerdo' => $data['id_acuerdo'],
                'actividad' => $data['actividad'],
                'fecha' => $data['fecha'],
                'id_responsable' => $data['id_responsable'],
                'avance' => 0,
                'reporte' => $data['reporte'],
//                'avance' => $data['avance'],
            ]);
    }
    
    
    public static function creaRegistroFicha($data) {
            return AcuerdosActividades::create([
                'id_acuerdo' => $data['id_acuerdo'],
                'actividad' => $data['actividad'],
                'fecha' => $data['fecha'],
                'id_responsable' => $data['id_responsable'],
                'avance' => 0,
            ]);
    }
    
    

    public static function editaRegistro($data) {
        $registro= AcuerdosActividades::find($data['id']);
        $registro->save();
        return true;
    }
    
    
    public function acuerdos(){
        return $this->belongsTo('App\Models\Acuerdos','id_acuerdo','id')->first();
    }
    
    public function usuario(){
        return $this->belongsTo('App\User','id_usuario','id')->first();
    }
    
    public function responsable(){
        return $this->belongsTo('App\User','id_acuerdo','id')->first();
    }
    
    public function areascolaboradoras(){
        $colab = AcuerdosColaboradores::where('id_actividad',$this->attributes['id'])->pluck('id_gabinete');
        $colaboradores = Gabinete::whereIn('id',$colab)->get();
        return $colaboradores;
    }
    /*
    public function areascolaboradoras(){
        return AcuerdosColaboradores::where('id_gabinete',$this->attributes['id_responsable'])->first();
    }*/
    /*la dependencia del responsable*/
    public function dependencia () {
        return $this->belongsTo('App\Models\Gabinete','id_responsable','id')->first();
    }
    
    public function actividadarchivo(){
        return AcuerdosArchivos::where('id_actividad',$this->attributes['id'])->first();
    }
    
    public function responsablearchivo(){
        return ResponsablesArchivos::where('id_actividad',$this->attributes['id'])->first();
    }
    
    public function nombreCompleto () {
        return $this->attributes['nombre']." ".$this->attributes['ap_paterno']." ".$this->attributes['ap_materno'];
    }
    
    public function archivo(){
        return AcuerdosArchivos::where('id_actividad',$this->attributes['id'])->get();
    }
    
    public function avance() {
        return EvidenciaResponsable::where('id_actividad',$this->attributes['id'])->get();
    }
    

}

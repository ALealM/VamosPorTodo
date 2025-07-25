<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ProgramasBeneficiarios extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'programas_beneficiarios';
    public $timestamps = false;
    protected $fillable = [
        'id_programa',
        'id_direccion',
        'nombre',
        'domicilio',
        'contacto',
        'ine',
        'id_usuario',
        'fecha',
        'id_demarcacionSC',
        'id_seccion',
        'id_colonia',
        'id_solicitud',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return ProgramasBeneficiarios::create([
                'id_programa' => $data['id_programa'],
                'id_direccion' => \Auth::User()->id_gabinete,
                'nombre' => $data['nombre'],
                'domicilio' => $data['domicilio'],
                'contacto' => $data['contacto'],
                'ine' => $data['ine'],
                'id_usuario' => \Auth::User()->id,
                'fecha' => date('Y-m-d H:i:s'),
                'id_demarcacionSC' => $data['id_demarcacionSC'],
                'id_seccion' => $data['id_seccion'],
                'id_colonia' => $data['id_colonia'],
                'id_solicitud' => $data['id_solicitud'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= ProgramasBeneficiarios::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->domicilio=$data['domicilio'];
        $registro->contacto=$data['contacto'];
        $registro->ine=$data['ine'];
        $registro->id_demarcacionSC=$data['id_demarcacionSC'];
        $registro->id_seccion=$data['id_seccion'];
        $registro->id_colonia=$data['id_colonia'];
        $registro->save();
        return true;
    }

    public function solicitud(){
        return $this->belongsTo('App\Models\Solicitudes','id_solicitud','id')->first();
    }
    
    public function colonia(){
        return $this->belongsTo('App\Models\ColoniasB','id_colonia','id')->first();
    }
    
    public function direccion(){
        return $this->belongsTo('App\Models\Gabinete','id_direccion','id')->first();
    }
}

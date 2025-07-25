<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Reportes extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'reportes';
    public $timestamps = false;
    protected $fillable = [
        'id_usuario',
        'medio',
        'area',
        'tipofalla',
        'calle',
        'numext',
        'numint',
        'colonia',
        'calle1',
        'calle2',
        'latitud',
        'longitud',
        'observaciones',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'telefono',
        'email',
        'genero',
        'rango',
        'visible',
        'evidencia',
        'folio',
        'fecha'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return Reportes::create([
                'id_usuario' => $data['id_usuario'],
                'medio' => $data['medio'],
                'area' => $data['area'],
                'tipofalla' => $data['tipofalla'],
                'calle' => $data['calle'],
                'numext' => $data['numext'],
                'numint' => $data['numint'],
                'colonia' => $data['colonia'],
                'calle1' => $data['calle1'],
                'calle2' => $data['calle2'],
                'latitud' => $data['latitud'],
                'longitud' => $data['longitud'],
                'observaciones' => $data['observaciones'],
                'nombre' => $data['nombre'],
                'ap_paterno' => $data['ap_paterno'],
                'ap_materno' => $data['ap_materno'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'genero' => $data['genero'],
                'rango' => $data['rango'],
                'visible' => $data['visible'],
                'evidencia' => $data['evidencia'],
                'folio' => $data['folio'],
                'fecha' => date('Y-m-d H:i:s'),
            ]);
    }

    public static function editaRegistro($data) {
        $registro= Acciones::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->descripcion=$data['descripcion'];
        $registro->estatus=2;
        $registro->fecha_edit=date('Y-m-d H:i:s');
        $registro->save();
        return true;
    }

    public function colonia(){
        return $this->belongsTo('App\Models\ColoniasRR','colonia','id_cp')->first();
    }

    public function calle(){
        return $this->belongsTo('App\Models\CallesRR','calle','id_cc')->first();
    }

    public function area(){
        return $this->belongsTo('App\Models\AreasAtencion','area','id')->first();
    }

    public function falla(){
        return $this->belongsTo('App\Models\FallasAtencion','tipofalla','id')->first();
    }

    public function medio(){
        return $this->belongsTo('App\Models\MediosRecepcion','medio','id')->first();
    }

    public function genero(){
        $genero = [1=>'Femenino',2=>'Masculino'];
        return $genero[$this->attributes['genero']];
    }

    public function edad(){
        $edad = [1=>'Joven (18-29)',2=>'Adulto Joven (30-39)',3=>'Adulto (40-60)',4=>'Adulto Mayor (mayor de 60)'];
        return $edad[$this->attributes['rango']];
    }

    public function avances() {
        return $this->belongsTo('App\Models\AvancesReporte','id','id_reporte')->get();
    }
}
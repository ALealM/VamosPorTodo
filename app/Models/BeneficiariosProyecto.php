<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class BeneficiariosProyecto extends Model {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'beneficiarios_proyecto';
    public $timestamps = false;
    protected $fillable = [
        'id_accion',
        'colonia',
        'id_tipo_beneficiario',
        'beneficiarios'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public static function creaRegistro($data) {
        return BeneficiariosProyecto::create([
                    'id_accion' => $data['id_accion'],
                    'colonia' => $data['colonia'],
                    'id_tipo_beneficiario' => $data['id_tipo_beneficiario'],
                    'beneficiarios' => $data['beneficiarios'],
        ]);
    }

    public static function editaRegistro($data) {
        $registro = Archivo::find($data['id_archivo']);
        $registro->nombre = $data['nombre'];
        $registro->descripcion = $data['descripcion'];
        $registro->fecha = $data['fecha'];
        $registro->folio_extra = @$data['folio_extra'];
        $registro->estatus = 2;
        $registro->fecha_edit = date('Y-m-d H:i:s');
        $registro->save();
        return true;
    }

    public function tipo(){
        return $this->belongsTo('App\Models\TipoBeneficiarios','id_tipo_beneficiario','id')->first();
    }

    public function colonia(){
        return $this->belongsTo('App\Models\Colonias','colonia','id')->first();
    }
}

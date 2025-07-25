<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Nomina extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'nomina';
    public $timestamps = false;
    protected $fillable = [
        'cve_direccion',
        'direccion',
        'cve_depto',
        'departamento',
        'cve_nomina',
        'tipo_nomina',
        'ap_paterno',
        'ap_materno',
        'nombre',
        'sexo',
        'cve_puesto',
        'puesto',
        'fecha_1',
        'fecha_ingreso',
        'tipo_contrato',
        'fecha_inicial',
        'fecha_final',
        'sueldo_diario',
        'sueldo_mensual',
        'rfc',
        'domicilio',
        'colonia',
        'cp',
        'telefono',
        'curp',
        'fecha_nacimiento',
        'ispt',
        'neto_pagar',
        'total',
        'id_quincena',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return Nomina::create([
                'cve_direccion' => $data['cve_direccion'],
                'direccion' => $data['direccion'],
                'cve_depto' => $data['cve_depto'],
                'departamento' => $data['departamento'],
                'cve_nomina' => $data['cve_nomina'],
                'tipo_nomina' => $data['tipo_nomina'],
                'ap_paterno' => $data['ap_paterno'],
                'ap_materno' => $data['ap_materno'],
                'nombre' => $data['nombre'],
                'sexo' => $data['sexo'],
                'cve_puesto' => $data['cve_puesto'],
                'puesto' => $data['puesto'],
                'fecha_1' => $data['fecha_1'],
                'fecha_ingreso' => $data['fecha_ingreso'],
                'tipo_contrato' => $data['tipo_contrato'],
                'fecha_inicial' => $data['fecha_inicial'],
                'fecha_final' => $data['fecha_final'],
                'sueldo_diario' => $data['sueldo_diario'],
                'sueldo_mensual' => $data['sueldo_mensual'],
                'rfc' => $data['rfc'],
                'domicilio' => $data['domicilio'],
                'colonia' => $data['colonia'],
                'cp' => $data['cp'],
                'telefono' => $data['telefono'],
                'curp' => $data['curp'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'ispt' => $data['ispt'],
                'neto_pagar' => $data['neto_pagar'],
                'total' => $data['total'],
                'id_quincena' => $data['id_quincena'],
            ]);
    }

}

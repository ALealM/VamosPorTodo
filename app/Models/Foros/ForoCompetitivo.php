<?php

namespace App\Models\Foros;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ForoCompetitivo extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'foro_competitivo';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'puesto',
        'domicilio',
        'colonia',
        'telefono',
        'dependencia',
        'archivo',
        'asistio',
        'genero',
        'divulgacion',
        'giro',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return ForoCompetitivo::create([
                'nombre' => $data['nombre'],
                'puesto' => isset($data['puesto']) ? $data['puesto'] : null,
                'domicilio' => isset($data['domicilio']) ? $data['domicilio'] : null,
                //'colonia' => 'colonia',
                'telefono' => isset($data['telefono']) ? $data['telefono'] : null,
                'genero' => $data['genero'],
                'divulgacion' => isset($data['divulgacion']) ? $data['divulgacion'] : null ,
                'dependencia' => isset($data['dependencia']) ? $data['dependencia'] : null ,
                'giro' => isset($data['giro']) ? $data['giro'] : null ,
                //'archivo' => $data['archivo'],
                'asistio' => 1,
            ]);
    }

    public static function editaRegistro($data) {
        $registro= ForoCompetitivo::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->puesto=$data['puesto'];
        $registro->domicilio=$data['domicilio'];
        $registro->colonia=$data['colonia'];
        $registro->telefono=$data['telefono'];
        $registro->dependencia=$data['dependencia'];
        $registro->archivo=$data['archivo'];
        $registro->save();
        return true;
    }


}
<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ForoSostenible extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'foro_sostenible';
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
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return ForoSostenible::create([
                'nombre' => $data['nombre'],
                'puesto' => isset($data['puesto']) ? $data['puesto'] : null,
                'domicilio' => isset($data['domicilio']) ? $data['domicilio'] : null,
                //'colonia' => 'colonia',
                'telefono' => isset($data['telefono']) ? $data['telefono'] : null,
                'genero' => $data['genero'],
                'dependencia' => isset($data['dependencia']) ? $data['dependencia'] : null ,
                //'archivo' => $data['archivo'],
                'asistio' => 1,
            ]);
    }

    public static function editaRegistro($data) {
        $registro= ForoSostenible::find($data['id']);
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
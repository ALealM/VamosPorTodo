<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Invitados extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'invitados';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'puesto',
        'dependencia',
        'lugar',
        'asistio',
        'integrante',
        'genero',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return Invitados::create([
                'nombre' => $data['nombre'],
                'puesto' => $data['puesto'],
                'dependencia' => $data['dependencia'],
                'lugar' => 'Sin lugar asignado',
                'asistio' => 1,
                'integrante' => $data['integrante'],
                'genero' => $data['genero'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= Invitados::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->puesto=$data['puesto'];
        $registro->dependencia=$data['dependencia'];
        $registro->lugar=$data['lugar'];
        $registro->save();
        return true;
    }


}

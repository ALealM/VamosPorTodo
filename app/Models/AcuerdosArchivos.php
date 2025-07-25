<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class AcuerdosArchivos extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'acuerdos_archivos';
    public $timestamps = false;
    protected $fillable = [
        'id_acuerdo',
        'id_actividad',
        'archivo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return AcuerdosArchivos::create([
                'id_acuerdo' => $data['id_acuerdo'],
                'id_actividad' => $data['id_actividad'],
                'archivo' => $data['archivo'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= AcuerdosArchivos::find($data['id']);
        $registro->id_acuerdo=$data['id_acuerdo'];
        $registro->id_actividad=$data['id_actividad'];
        $registro->archivo=$data['archivo'];
        $registro->save();
        return true;
    }
    
    
}

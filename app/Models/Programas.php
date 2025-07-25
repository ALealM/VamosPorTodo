<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Programas extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'programas';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'fecha_alta',
        'id_usuario',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return Programas::create([
                'nombre' => $data['nombre'],
                'fecha_alta' => date('Y-m-d H:i:s'),
                'id_usuario' => \Auth::User()->id,
            ]);
    }

    public static function editaRegistro($data) {
        $registro= Programas::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->save();
        return true;
    }

}

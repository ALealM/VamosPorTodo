<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ProgramasDireccion extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'programas_direccion';
    public $timestamps = false;
    protected $fillable = [
        'id_programa',
        'id_direccion',
        'id_usuario',
        'fecha'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($id) {
            return ProgramasDireccion::create([
                'id_programa' => $id,
                'id_direccion' => \Auth::User()->id_gabinete,
                'id_usuario' => \Auth::User()->id,
                'fecha' => date('Y-m-d H:i:s'),
            ]);
    }
}

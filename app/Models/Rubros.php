<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Rubros extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'rubros';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return Rubros::create([
                'nombre' => $data['nombre'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= Rubros::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->save();
        return true;
    }

}

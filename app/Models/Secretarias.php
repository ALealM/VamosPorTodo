<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Secretarias extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'secretarias';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'siglas',
    ];

    public static function creaRegistro($data)
    {
        return Secretarias::create([
            'nombre' => $data['nombre'],
            'siglas' => $data['siglas'],
        ]);
    }
    
    public static function editaRegistro($data) {
        $registro= Secretarias::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->siglas=$data['siglas'];
        $registro->save();
        return true;
    }
}

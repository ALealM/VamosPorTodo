<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Colonias extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'colonias';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
    ];

    public static function creaRegistro($data)
    {
        return Colonias::create([
            'nombre' => $data['nombre'],
        ]);
    }
    
    public static function editaRegistro($data) {
        $registro= Colonias::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->save();
        return true;
    }
}

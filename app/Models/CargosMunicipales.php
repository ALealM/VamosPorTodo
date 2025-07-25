<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class CargosMunicipales extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'cargos_municipales';
    public $timestamps = false;
    protected $fillable = [
        'direccion_gral',
        'cargo',
        'nombre',
        'genero',
        'fotografia',
        'telefono',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static function editaRegistro($data) {
        $registro= CargosMunicipales::find($data['id']);
        $registro->direccion_gral=$data['direccion_gral'];
        $registro->cargo=$data['cargo'];
        $registro->nombre=$data['nombre'];
        $registro->genero=$data['genero'];
        $registro->fotografia=$data['fotografia'];
        $registro->telefono=$data['telefono'];
        $registro->save();
        return true;
    }
    
}

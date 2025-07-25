<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ServicioMunicipalDescripcion extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'servicio_municipal_descripcion';
    public $timestamps = false;
    protected $fillable = [
        'id_servicio_municipal',
        'unidad',
        'ubicacion',
        'trabajo',
        'folio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function newRegistro($data) {
        return ServicioMunicipalDescripcion::create([
            'id_servicio_municipal' => $data['id'],
            'unidad' => $data['unidad'],
            'ubicacion' => $data['ubicacion'],
            'trabajo' => $data['trabajo'],
            'folio' => $data['folio'],
        ]);
    }

    public static function editarRegistro($data) {
        $registro= Acciones::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->descripcion=$data['descripcion'];
        $registro->estatus=2;
        $registro->fecha_edit=date('Y-m-d H:i:s');
        $registro->save();
        return true;
    }
}
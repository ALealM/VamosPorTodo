<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class AccionesAc extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'acciones_ac';
    public $timestamps = false;
    protected $fillable = [
        'id_area',
        'programa',
        'tipo',
        'objetivo',
        'indicador',
        'formula',
        'meta',
        'id_unidad',
    ];

    public static function creaRegistro($data)
    {
        return AccionesAc::create([
            'id_area' => $data['id_area'],
            'programa' => $data['programa'],
            // 'tipo' => $data['tipo'],
            'objetivo' => $data['objetivo'],
            'indicador' => $data['indicador'],
            // 'formula' => $data['formula'],
            'meta' => $data['meta'],
            'id_unidad' => $data['id_unidad'],
        ]);
    }

    public static function editaRegistro($data) {
        $registro= AccionesAc::find($data['id']);
        $registro->programa=$data['programa'];
        // $registro->tipo=$data['tipo'];
        $registro->objetivo=$data['objetivo'];
        $registro->indicador=$data['indicador'];
        // $registro->formula=$data['formula'];
        $registro->meta=$data['meta'];
        $registro->id_unidad=$data['id_unidad'];
        $registro->save();
        return true;
    }

    public function unidad(){
        return $this->belongsTo('App\Models\UnidadesAc','id_unidad','id')->first();
    }

    public function direccion(){
        return $this->belongsTo('App\Models\AreasAc','id_area','id')->first();
    }

}

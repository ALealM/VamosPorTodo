<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class IndicadoresPlanDM extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'indicadores_plan_dm';
    public $timestamps = false;
    protected $fillable = [
        'id_estrategia',
        'indicador',
        'numero',
        'id_unidad_indicador',
        'meta',
        'id_frecuencia_indicador',
        'formula',
        'meta_tiempo',
        'comentarios',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return IndicadoresPlanDM::create([
                'id_estrategia' => $data['id_estrategia'],
                'indicador' => $data['indicador'],
                'numero' => $data['numero'],
                'id_unidad_indicador' => $data['id_unidad_indicador'],
                'meta' => $data['meta'],
                'id_frecuencia_indicador' => $data['id_frecuencia_indicador'],
                'formula' => $data['formula'],
                'meta_tiempo' => $data['meta_tiempo'],
                'comentarios' => $data['comentarios'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= IndicadoresPlanDM::find($data['id']);
        $registro->id_estrategia=$data['id_estrategia'];
        $registro->indicador=$data['indicador'];
        $registro->id_unidad_indicador=$data['id_unidad_indicador'];
        $registro->meta=$data['meta'];
        $registro->id_frecuencia_indicador=$data['id_frecuencia_indicador'];
        $registro->formula=$data['formula'];
        $registro->meta_tiempo=$data['meta_tiempo'];
        $registro->comentarios=$data['comentarios'];
        $registro->save();
        return true;
    }

    public function estrategia(){
        return $this->belongsTo('App\Models\EstrategiasPlanDM','id_estrategia','id')->first();
    }
    
    public function unidad(){
        return $this->belongsTo('App\Models\UnidadesIndicadores','id_unidad_indicador','id')->first();
    }
    
    public function frecuencia(){
        return $this->belongsTo('App\Models\FrecuenciasIndicadores','id_frecuencia_indicador','id')->first();
    }

}

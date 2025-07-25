<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class SPEventosImpacto extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sp_eventos_impacto';
    public $timestamps = false;
    protected $fillable = [
        'evento',
        'cantidad',
        'id_informe'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return SPEventosImpacto::create([
                'evento' => $data['evento'],
                'cantidad' => $data['cantidad'],
                'id_informe' => $data['id_informe'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= SPEventosImpacto::find($data['id']);
        $registro->evento=$data['evento'];
        $registro->cantidad=$data['cantidad'];
        $registro->save();
        return true;
    }

    public function tipo(){
        return $this->belongsTo('App\Models\TipoAcciones','id_tipo_accion','id')->first();
    }    

}

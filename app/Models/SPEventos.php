<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class SPEventos extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sp_eventos';
    public $timestamps = false;
    protected $fillable = [
        'id_evento_cat',
        'cantidad',
        'id_informe',
        'tipo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return SPEventos::create([
                'id_evento_cat' => $data['id_evento_cat'],
                'cantidad' => $data['cantidad'],
                'id_informe' => $data['id_informe'],
                'tipo' => $data['tipo']
            ]);
    }

    public static function editaRegistro($data) {
        $registro= SPEventos::find($data['id']);
        $registro->cantidad=$data['cantidad'];
        $registro->save();
        return true;
    }

    public function evento(){
        return $this->belongsTo('App\Models\SPEventosCat','id_evento_cat','id')->first();
    }    

}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Informe extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'informe';
    public $timestamps = false;
    protected $fillable = [
        'informe',
        'fecha',
        'fecha_alta',
        'id_gabinete',
        'estatus',
        'comentarios',
        'orden',
        'observaciones',
        'id_usuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return Informe::create([
                'informe' => $data['informe'],
                'fecha' => $data['fecha'],
                'fecha_alta' => date('Y-m-d H:i:s'),
                'orden' => $data['orden'],
                'id_usuario' => \Auth::User()->id,
                'id_gabinete' => \Auth::User()->id_gabinete,
                'estatus' => 0
            ]);
    }

    public static function editaRegistro($data) {
        $registro= Informe::find($data['id']);
        $registro->informe=$data['informe'];
        $registro->fecha=$data['fecha'];
        $registro->estatus=0;
        $registro->save();
        return true;
    }

    public static function revisaRegistro($data) {
        $registro= Informe::find($data['id']);
        $registro->informe=$data['informe'];
        $registro->estatus=$data['estatus'];
        $registro->comentarios=$data['comentarios'];
        $registro->save();
        return true;
    }

    public static function comentariosRegistro($data) {
        $registro= Informe::find($data['id']);
        $registro->observaciones=$data['observaciones'];
        $registro->save();
        return true;
    }

    public function estatus(){
        $estatus = [0=>'Borrador',1=>'Enviado',2=>'Aceptado',3=>'Complementar'];
        return $estatus[$this->attributes['estatus']];
    }

    public function user(){
        return $this->belongsTo('App\User','id_usuario','id')->first();
    }

    public function direccion(){
        return $this->belongsTo('App\Models\Gabinete','id_gabinete','id')->first();
    }
    
    public function vestimenta(){
        $codigo = [0=>'Casual',1=>'Formal',2=>'Indiferente'];
        return $codigo[$this->attributes['vestimenta']];
    }
    
    public function imagenes(){
        return InformeAnexos::where('id_informe',$this->attributes['id'])->where('tipo',1)->get();
    }
    
    public function documentos(){
        return InformeAnexos::where('id_informe',$this->attributes['id'])->where('tipo',2)->get();
    }
}

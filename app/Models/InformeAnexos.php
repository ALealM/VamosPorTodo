<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class InformeAnexos extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'informe_anexos';
    public $timestamps = false;
    protected $fillable = [
        'id_informe',
        'id_usuario',
        'anexo',
        'tipo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return InformeAnexos::create([
                'id_informe' => $data['id_informe'],
                'id_usuario' => \Auth::User()->id,
                'anexo' => $data['anexo'],
                'tipo' => $data['tipo']
            ]);
    }

    public static function editaRegistro($data) {
        $registro= EventosReporte::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->descripcion=$data['descripcion'];
        $registro->estatus=2;
        $registro->fecha_edit=date('Y-m-d H:i:s');
        $registro->save();
        return true;
    }


}

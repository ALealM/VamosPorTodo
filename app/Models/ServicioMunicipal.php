<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

use App\Models\ServicioMunicipalDescripcion as SMD;

class ServicioMunicipal extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'servicio_municipal';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'turno',
        'supervisor',
        'telefono',
        'fecha_alta',
        'id_user',
        'fecha_update',
        'user_update',
        'activo',
        'day', // 1 -> Sábado      ;       2 -> Domingo        ;     3 -> otro
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function newRegistro($data) {
        foreach ($data['folio'] as $folio)
            if( SMD::where('folio', $folio)->first() )
                return false;
        $new = ServicioMunicipal::create([
            'fecha' => $data['fecha'],
            'turno' => $data['turno'],
            'supervisor' => $data['name'],
            'telefono' => $data['tel'],
            'fecha_alta' => date('Y-m-d H:i:s'),
            'id_user' => \Auth::User()->id,
            'day' => date( 'l', strtotime( $data['fecha'] ) ) == 'Saturday' ? 1 : (date( 'l', strtotime( $data['fecha'] ) ) == 'Sunday' ? 2 : 3),
        ]);
        if($new){
            foreach ($data['unidad'] as $key => $dat) {
                $newRegister = SMD::newRegistro( ['id' => $new->id, 'unidad' => $data['unidad'][$key], 'ubicacion' => $data['ubicacion'][$key], 'trabajo' => $data['trabajo'][$key], 'folio' => $data['folio'][$key] ] );
                if ( !$newRegister ) {
                    SMD::where( 'id_servicio_municipal', $new->id )->delete();
                    ServicioMunicipal::where( 'id', $new->id )->delete();
                }
            }
            return $new;
        }
        else return false;
    }

    public static function editar($data) {
        $registro = ServicioMunicipal::find($data['id']);
        $registro->fecha = $data['fecha'];
        $registro->turno = $data['turno'];
        $registro->supervisor = $data['name'];
        $registro->telefono = $data['tel'];
        $registro->fecha_update = date('Y-m-d H:i:s');
        $registro->user_update = \Auth::User()->id;
        $registro->day = date( 'l', strtotime( $data['fecha'] ) ) == 'Sunday' || date( 'l', strtotime( $data['fecha'] ) ) == 'Saturday' ? 1 : 2;
        if( $registro->save() ){
            SMD::where('id_servicio_municipal', $data['id'])->delete();
            foreach ($data['unidad'] as $key => $dat) {
                $newRegister = SMD::newRegistro( ['id' => $data['id'], 'unidad' => $data['unidad'][$key], 'ubicacion' => $data['ubicacion'][$key], 'trabajo' => $data['trabajo'][$key], 'folio' => $data['folio'][$key] ] );
            }
            return true;
        }
        return false;
    }
    
    public function turno(){
        $turno = [ 1 =>'Matutino', 2 =>'Vespertino'];
        return $turno[ $this->attributes['turno'] ];
    }
}
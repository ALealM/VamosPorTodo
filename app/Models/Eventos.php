<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Eventos extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'eventos';
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'lugar',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'vestimenta',
        'montaje',
        'invitados_e',
        'invitados',
        'fecha_alta',
        'id_usuario',
        'estatus',
        'folio',
        'ubicacion',
        'semaforo',
        'asistencia_presidente',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
        $presidente = @$data['presidente'] ? 1 : 0;
        return Eventos::create([
            'folio' => $data['folio'],
            'titulo' => $data['titulo'],
            'lugar' => $data['lugar'],
            'fecha' => $data['fecha'],
            'hora_inicio' => $data['hora_inicio'],
            'hora_fin' => $data['hora_fin'],
            'vestimenta' => $data['vestimenta'],
            'montaje' => $data['montaje'],
            'invitados_e' => $data['invitados_e'],
            'invitados' => $data['invitados'],
            'ubicacion' => $data['ubicacion'],
            'fecha_alta' => date('Y-m-d H:i:s'),
            'id_usuario' => \Auth::User()->id,
            'semaforo' => $data['semaforoId'],
            'asistencia_presidente' => $presidente,
            'estatus' => 0
        ]);
    }

    public static function editaRegistro($data) {
        $presidente = @$data['presidente'] ? 1 : 0;
        $registro = Eventos::find($data['id']);
        if($registro->diario == 1){
            $registro->diario = 0;
        }
        $registro->titulo=$data['titulo'];
        $registro->lugar=$data['lugar'];
        $registro->fecha=$data['fecha'];
        $registro->hora_inicio=$data['hora_inicio'];
        $registro->hora_fin=$data['hora_fin'];
        $registro->vestimenta=$data['vestimenta'];
        $registro->montaje=$data['montaje'];
        $registro->invitados_e=$data['invitados_e'];
        $registro->invitados=$data['invitados'];
        $registro->ubicacion=$data['ubicacion'];
        $registro->semaforo=$data['semaforoId'];
        $registro->asistencia_presidente = $presidente;
        $registro->save();
        return true;
    }

    public function estatus(){
        $estatus = [0=>'Borrador',1=>'Pendiente',2=>'En Revisión',3=>'Autorizado',4=>'No Autorizado'];
        return $estatus[$this->attributes['estatus']];
    }

    public function user(){
        return $this->belongsTo('App\User','id_usuario','id')->first();
    }
    
    public function vestimenta(){
        $codigo = [0=>'Casual',1=>'Formal',2=>'Indiferente'];
        return $codigo[$this->attributes['vestimenta']];
    }
}
                                                       
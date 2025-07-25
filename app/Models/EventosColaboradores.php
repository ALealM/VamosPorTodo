<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class EventosColaboradores extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'eventos_colaboradores';
    public $timestamps = false;
    protected $fillable = [
        'id_evento',
        'id_gabinete'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static function creaRegistro($data) {
            return EventosColaboradores::create([
                'id_evento' => $data['id_evento'],
                'id_gabinete' => $data['id_gabinete']
            ]);
    }

    public function gabinete(){
        return $this->belongsTo('App\Models\Gabinete','id_gabinete','id')->first();
    }

    public function imagenes(){
        $col = EventosColaboradores::find($this->attributes['id']);
        $usr = User::where('id_gabinete',$col->id_gabinete)->first();
        return EventosReporte::where('id_evento',$col->id_evento)->where('id_usuario',$usr->id)->where('tipo',1)->get();
    }

    public function documentos(){
        $col = EventosColaboradores::find($this->attributes['id']);
        $usr = User::where('id_gabinete',$col->id_gabinete)->first();
        return EventosReporte::where('id_evento',$col->id_evento)->where('id_usuario',$usr->id)->where('tipo',2)->get();
    }
}

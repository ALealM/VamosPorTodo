<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class AreasAtencion extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'areas_atencion';
    public $timestamps = false;

    protected $fillable = [
        'area',
        'id_gabinete',
        'siglas',
        'fondo',
        'icon',
        'tiempo_respuesta',
        'id_unidad_time'
    ];

    public function timeResponse(){
        return @$this->attributes['tiempo_respuesta'] . ' ' . @\DB::table('tiempo_unidad')->find( $this->attributes['id_unidad_time'] )->unidad;
    }
}
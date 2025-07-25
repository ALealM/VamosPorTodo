<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class AccionesGob extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'acciones_gob';
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     public function color(){
         return $this->belongsTo('App\Models\VotosSecciones','dl','dl')->where('votos_secciones.anio',2018)->first();
     }

}

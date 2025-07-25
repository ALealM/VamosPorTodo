<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class RubrosGasto extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'rubros_gasto';        

    public function capitulo(){
        return $this->belongsTo('App\Models\CapitulosGasto','id_capitulo','id')->first();
    }
}

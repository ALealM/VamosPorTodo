<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ConceptosGasto extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'conceptos_gasto';        

    public function rubro(){
        return $this->belongsTo('App\Models\RubrosGasto','id_rubro','id')->first();
    }
}

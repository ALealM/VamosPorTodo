<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ObjetivosDesarrolloSostenible extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'objetivos_desarrollo_sostenible';        

    public function getObjDescAttribute(){
        return $this->attributes['objetivo']." - ".$this->attributes['descripcion'];
    }
}

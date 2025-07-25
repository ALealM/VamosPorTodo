<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class CapitulosGasto extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'capitulos_gasto';        

    public function getCapDescAttribute(){
        return $this->attributes['capitulo']." - ".$this->attributes['descripcion'];
    }

    public function capDesc(){
        return $this->attributes['capitulo']." - ".$this->attributes['descripcion'];
    }
}

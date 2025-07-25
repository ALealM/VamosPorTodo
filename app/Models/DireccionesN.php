<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class DireccionesN extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'direccionesN';

    public function getCveDirAttribute(){
        return $this->attributes['cve_direccion']." - ".$this->attributes['direccion'];
    }
}

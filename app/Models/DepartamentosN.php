<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class DepartamentosN extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'departamentosN';

    public function getCveDepAttribute(){
        return $this->attributes['cve_depto']." - ".$this->attributes['departamento'];
    }
}

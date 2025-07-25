<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Meses extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'meses';      
    
    public function monto(){
        return $this->belongsTo('App\Models\CalendarioEjecucion','id','mes')->sum('monto');
    }
    
    public function monto2($idP){
        return $this->belongsTo('App\Models\CalendarioEjecucion','id','mes')->whereIN('id_proyecto',$idP)->sum('monto');
    }

}

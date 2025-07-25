<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class CalendarioEjecucion extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'calendario_ejecucion';
    public $timestamps = false;
    protected $fillable = [
        'monto',
        'mes',
        'id_proyecto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return CalendarioEjecucion::create([
                'monto' => $data['monto'],
                'mes' => $data['mes'],
                'id_proyecto' => $data['id_proyecto']
            ]);
    }

    public static function editaRegistro($data) {
        $registro= CalendarioEjecucion::find($data['id']);
        $registro->monto=$data['monto'];
        $registro->save();
        return true;
    }  
    
    public function mes(){
        return $this->belongsTo('App\Models\Meses','mes','id')->first();
    }

}

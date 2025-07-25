<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class AcuerdosColaboradores extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'acuerdos_colaboradores';
    public $timestamps = false;
    protected $fillable = [
        'id_actividad',
        'id_gabinete',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return AcuerdosColaboradores::create([
                'id_actividad' => $data['id_actividad'],
                'id_gabinete' => $data['id_gabinete'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= AcuerdosColaboradores::find($data['id']);
        $registro->id_gabinete=$data['colaboradores'];
        $registro->save();
        return true;
    }
    
     public function gabinete(){
        return $this->belongsTo('App\Models\Gabinete','id_gabinete','id')->first();
    }

}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Avances extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'avances';
    public $timestamps = false;
    protected $fillable = [
        'id_accion',
        'id_mes',
        'avance'
    ];

    public static function creaRegistro($data)
    {
        return Avances::create([
            'id_accion' => $data['id_accion'],
            'id_mes' => $data['id_mes'],
            'avance' => $data['avance'],
        ]);
    }

    public static function editaRegistro($data) {
        $registro= Avances::find($data['id']);
        $registro->avance=$data['avance'];
        $registro->save();
        return true;
    }

    public function mes(){
        return $this->belongsTo('App\Models\Meses','id_mes','id')->first();
    }

    public function accion(){
        return $this->belongsTo('App\Models\Acciones','id_accion','id')->first();
    }

}

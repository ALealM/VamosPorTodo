<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class EstrategiasPlanDM extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'estrategias_plan_dm';
    public $timestamps = false;
    protected $fillable = [
        'id_eje',
        'numero',
        'estrategia',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return EstrategiasPlanDM::create([
                'id_eje' => $data['id_eje'],
                'numero' => $data['numero'],
                'estrategia' => $data['estrategia'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= EstrategiasPlanDM::find($data['id']);
        $registro->estrategia=$data['estrategia'];
        $registro->save();
        return true;
    }

    public function eje(){
        return $this->belongsTo('App\Models\EjesPlanDM','id_eje','id')->first();
    }    

}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class EstructuraFinanciera extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'estructura_financiera';
    public $timestamps = false;
    protected $fillable = [
        'monto',
        'estructura',
        'id_proyecto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return EstructuraFinanciera::create([
                'monto' => $data['monto'],
                'estructura' => $data['estructura'],
                'id_proyecto' => $data['id_proyecto']
            ]);
    }

    public static function editaRegistro($data) {
        $registro= EstructuraFinanciera::find($data['id']);
        $registro->monto=$data['monto'];
        $registro->save();
        return true;
    }  

}

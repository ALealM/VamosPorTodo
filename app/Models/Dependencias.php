<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Dependencias extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'dependencias';
    public $timestamps = false;
    protected $fillable = [
        'dependencia',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    public static function creaRegistro($data) {
        return Dependencias::create([
                                'dependencia' => $data['dependencia'],
                                ]);
    }
    
    
    public static function editaRegistro($data) {
        $registro= Dependencias::find($data['id']);
        $registro->dependencia=$data['dependencia'];
        $registro->save();
        return true;
    }
    
}

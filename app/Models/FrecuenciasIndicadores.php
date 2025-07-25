<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class FrecuenciasIndicadores extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'frecuencias_indicadores';
    public $timestamps = false;
    protected $fillable = [
        'frecuencia',
        'orden',
    ];

    public static function creaRegistro($data)
    {
        return FrecuenciasIndicadores::create([
            'frecuencia' => $data['frecuencia'],
//            'orden' => $data['orden'],
            'orden' => 10,
        ]);
    }
    
    public static function editaRegistro($data) {
        $registro= FrecuenciasIndicadores::find($data['id']);
        $registro->frecuencia=$data['frecuencia'];
        $registro->save();
        return true;
    }
    
}
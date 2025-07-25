<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class UnidadesIndicadores extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'unidades_indicadores';
    public $timestamps = false;
    protected $fillable = [
        'unidad',
    ];

    public static function creaRegistro($data)
    {
        return UnidadesIndicadores::create([
            'unidad' => $data['unidad'],
        ]);
    }
    
    public static function editaRegistro($data) {
        $registro= UnidadesIndicadores::find($data['id']);
        $registro->unidad=$data['unidad'];
        $registro->save();
        return true;
    }
    
}

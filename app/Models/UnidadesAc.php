<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class UnidadesAc extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'unidades_ac';
    public $timestamps = false;
    protected $fillable = [
        'unidad',
    ];

    public static function creaRegistro($data)
    {
        return UnidadesAc::create([
            'unidad' => $data['unidad'],
        ]);
    }

    public static function editaRegistro($data) {
        $registro= UnidadesAc::find($data['id']);
        $registro->unidad=$data['unidad'];
        $registro->save();
        return true;
    }

}

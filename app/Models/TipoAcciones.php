<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class TipoAcciones extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tipo_acciones';
    public $timestamps = false;
    protected $fillable = [
        'tipo',
    ];

    public static function creaRegistro($data)
    {
        return TipoAcciones::create([
            'tipo' => $data['tipo'],
        ]);
    }
    
    public static function editaRegistro($data) {
        $registro= TipoAcciones::find($data['id']);
        $registro->tipo=$data['tipo'];
        $registro->save();
        return true;
    }
    
}

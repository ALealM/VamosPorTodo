<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Responsables extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'responsables';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'id_secretaria',
    ];

    public static function creaRegistro($data)
    {
        return Responsables::create([
            'nombre' => $data['nombre'],
            'id_secretaria' => $data['id_secretaria'],
        ]);
    }
    
    public static function editaRegistro($data) {
        $registro= Responsables::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->id_secretaria=$data['id_secretaria'];
        $registro->save();
        return true;
    }
    
    public function secretaria(){
        return $this->belongsTo('App\Models\Secretarias','id_secretaria','id')->first();
    }
}

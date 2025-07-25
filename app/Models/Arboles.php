<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Arboles extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'arboles';
    public $timestamps = false;
    protected $fillable = [
        'id_parque_jardin',
        'especie',
        'altura',
        'diametro_tronco',
        'accion', // 1 -> Inspección; 2 => Restitución
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public static function new($data) {
        return Arboles::create([
            'id_parque_jardin' => $data['id'],
            'especie' => $data['especie'],
            'altura' => $data['altura'],
            'diametro_tronco' => $data['diametro_tronco'],
            'accion' => $data['accion']
        ]);
    }
}
<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class EcologiaActividades extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ecologia_actividad';
    public $timestamps = false;
    protected $fillable = [
        'id_ecologia',
        'actividad',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function new($data) {
        return EcologiaActividades::create([
            'id_ecologia' => $data['id'],
            'actividad' => $data['act']
        ]);
    }
}

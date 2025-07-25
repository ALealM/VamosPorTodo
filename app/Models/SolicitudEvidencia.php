<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class SolicitudEvidencia extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'solicitud_evidencia';
    public $timestamps = false;
    protected $fillable = [
        'id_solicitud',
        'archivo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    public static function creaRegistro($data) {
            return SolicitudEvidencia::create([
                'id_solicitud' => $data['id_solicitud'],
                'archivo' => $data['archivo']
            ]);
    }
    
}

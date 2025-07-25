<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class FallasAtencion extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'fallas_atencion';
    public $timestamps = false;
    protected $fillable = [
        'id_area',
        'falla',
    ];

    public static function creaRegistro($data) {
            return FallasAtencion::create([
                'id_area' => $data['id_area'],
                'falla' => $data['falla'],
            ]);
    }

}

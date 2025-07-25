<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class SPDelegaciones extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sp_delegaciones';
    public $timestamps = false;
    protected $fillable = [
        'fb',
        'fpz',
        'flp',
        'vb',
        'vpz',
        'vlp',
        'id_informe'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return SPDelegaciones::create([
                'fb' => $data['fb'],
                'fpz' => $data['fpz'],
                'flp' => $data['flp'],
                'vb' => $data['vb'],
                'vpz' => $data['vpz'],
                'vlp' => $data['vlp'],
                'id_informe' => $data['id_informe'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= SPDelegaciones::find($data['id']);
        $registro->fb=$data['fb'];
        $registro->fpz=$data['fpz'];
        $registro->flp=$data['flp'];
        $registro->vb=$data['vb'];
        $registro->vpz=$data['vpz'];
        $registro->vlp=$data['vlp'];
        $registro->save();
        return true;
    }  

}

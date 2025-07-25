<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class SPBarandilla extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sp_barandilla';
    public $timestamps = false;
    protected $fillable = [
        'pjc',
        'pof',
        'djc',
        'dof',
        'fjc',
        'fof',
        'id_informe',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return SPBarandilla::create([
                'pjc' => $data['pjc'],
                'pof' => $data['pof'],
                'djc' => $data['djc'],
                'dof' => $data['dof'],
                'fjc' => $data['fjc'],
                'fof' => $data['fof'],
                'id_informe' => $data['id_informe'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= SPBarandilla::find($data['id']);
        $registro->pjc=$data['pjc'];
        $registro->pof=$data['pof'];
        $registro->djc=$data['djc'];
        $registro->dof=$data['dof'];
        $registro->fjc=$data['fjc'];
        $registro->fof=$data['fof'];
        $registro->save();
        return true;
    }  

}

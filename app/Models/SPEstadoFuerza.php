<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class SPEstadoFuerza extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sp_estado_fuerza';
    public $timestamps = false;
    protected $fillable = [
        'pc',
        'pn',
        'pp',
        'ps',
        'po',
        'pv',
        'dc',
        'dn',
        'dp',
        'ds',
        'do',
        'dv',
        'fc',
        'fn',
        'fp',
        'fs',
        'fo',
        'fv',
        'id_informe',
        'tipo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return SPEstadoFuerza::create([
                'pc' => $data['pc'],
                'pn' => $data['pn'],
                'pp' => $data['pp'],
                'ps' => $data['ps'],
                'po' => $data['po'],
                'pv' => $data['pv'],
                'dc' => $data['dc'],
                'dn' => $data['dn'],
                'dp' => $data['dp'],
                'ds' => $data['ds'],
                'do' => $data['do'],
                'dv' => $data['dv'],
                'fc' => $data['fc'],
                'fn' => $data['fn'],
                'fp' => $data['fp'],
                'fs' => $data['fs'],
                'fo' => $data['fo'],
                'fv' => $data['fv'],
                'id_informe' => $data['id_informe'],
                'tipo' => $data['tipo']
            ]);
    }

    public static function editaRegistro($data) {
        $registro= SPEstadoFuerza::find($data['id']);
        $registro->pc=$data['pc'];
        $registro->pn=$data['pn'];
        $registro->pp=$data['pp'];
        $registro->ps=$data['ps'];
        $registro->po=$data['po'];
        $registro->pv=$data['pv'];
        $registro->dc=$data['dc'];
        $registro->dn=$data['dn'];
        $registro->dp=$data['dp'];
        $registro->ds=$data['ds'];
        $registro->do=$data['do'];
        $registro->dv=$data['dv'];
        $registro->fc=$data['fc'];
        $registro->fn=$data['fn'];
        $registro->fp=$data['fp'];
        $registro->fs=$data['fs'];
        $registro->fo=$data['fo'];
        $registro->fv=$data['fv'];
        $registro->save();
        return true;
    }  

}

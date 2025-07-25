<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class EjesPlanDM extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ejes_plan_dm';
    public $timestamps = false;
    protected $fillable = [
        'eje',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return EjesPlanDM::create([
                'eje' => $data['eje'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= EjesPlanDM::find($data['id']);
        $registro->eje=$data['eje'];
        $registro->save();
        return true;
    }

    public function tipo(){
        return $this->belongsTo('App\Models\TipoAcciones','id_tipo_accion','id')->first();
    }
    
    public function responsables(){
        $responsables = '';
        $resp = ResponsablesProyecto::where('id_accion',$this->attributes['id'])->get();
        foreach ($resp as $r){
            $responsable = Responsables::find($r->id_responsable);
            $sec = Secretarias::find($responsable->id_secretaria);
            $responsables.= $sec->siglas.", ";
        }
        return trim($responsables, ', ');
    }
    
    public function beneficiarios(){
        $beneficiarios = '';
        $ben = BeneficiariosProyecto::select(\DB::raw('sum(beneficiarios) ben, id_tipo_beneficiario'))->where('id_accion',$this->attributes['id'])->groupBy('id_tipo_beneficiario')->get();
        foreach ($ben as $b){
            $tipoB = TipoBeneficiarios::find($b->id_tipo_beneficiario);
            $beneficiarios.= $b->ben." ".$tipoB->tipo.", ";
        }
        return trim($beneficiarios, ', ');
    }

}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Acciones extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'acciones';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'id_tipo_accion',
        'descripcion',
        'problematica',
        'medio_accion',
        'indicador_objetivo',
        'indicador_beneficiarios',
        'presupuesto_utopico',
        'eje_plan_dm',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return Acciones::create([
                'nombre' => $data['nombre'],
                'id_tipo_accion' => $data['id_tipo_accion'],
                'descripcion' => $data['descripcion'],
                'problematica' => $data['problematica'],
                'medio_accion' => $data['medio_accion'],
                'indicador_objetivo' => $data['indicador_objetivo'],
                'indicador_beneficiarios' => $data['indicador_beneficiarios'],
                'presupuesto_utopico' => $data['presupuesto_utopico'],
                'eje_plan_dm' => $data['eje_plan_dm'],
            ]);
    }

    public static function editaRegistro($data) {
        $registro= Acciones::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->descripcion=$data['descripcion'];
        $registro->estatus=2;
        $registro->fecha_edit=date('Y-m-d H:i:s');
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
    
    public function eje(){
        return $this->belongsTo('App\Models\EjesPlanDM','eje_plan_dm','id')->first();
    }

}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ProyectosAcciones extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'proyectos_acciones';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'descripcion',
        'id_concepto',
        'beneficiarios',
        'id_fuente',
        'id_eje',
        'id_objetivo',
        'id_usuario',
        'macroproyecto',
        'fecha_alta'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function creaRegistro($data) {
            return ProyectosAcciones::create([
                'nombre' => $data['nombre'],
                'macroproyecto' => $data['macroproyecto'],
                'descripcion' => $data['descripcion'],
                'id_concepto' => $data['id_concepto'],
                'beneficiarios' => $data['beneficiarios'],
                'id_fuente' => $data['id_fuente'],
                'id_eje' => $data['id_eje'],
                'id_objetivo' => $data['id_objetivo'],
                'id_usuario' => \Auth::User()->id,
                'fecha_alta' => date('Y-m-d H:i:s'),
            ]);
    }

    public static function editaRegistro($data) {
        $registro= ProyectosAcciones::find($data['id']);
        $registro->nombre=$data['nombre'];
        $registro->macroproyecto=$data['macroproyecto'];
        $registro->descripcion=$data['descripcion'];
        $registro->id_concepto=$data['id_concepto'];
        $registro->beneficiarios=$data['beneficiarios'];
        $registro->id_fuente=$data['id_fuente'];
        $registro->id_eje=$data['id_eje'];
        $registro->id_objetivo=$data['id_objetivo'];
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
    
    public function fuente(){
        return $this->belongsTo('App\Models\FuentesFinanciamiento','id_fuente','id')->first();
    }
    
    public function concepto(){
        return $this->belongsTo('App\Models\ConceptosGasto','id_concepto','id')->first();
    }
    
    public function ejeRector(){
        return $this->belongsTo('App\Models\EjesRectores','id_eje','id')->first();
    }
    
    public function objetivo(){
        return $this->belongsTo('App\Models\ObjetivosDesarrolloSostenible','id_objetivo','id')->first();
    }
    
    public function usuario(){
        return $this->belongsTo('App\User','id_usuario','id')->first();
    }
    
    public function inversion(){
        return EstructuraFinanciera::where('id_proyecto', $this->attributes['id'])->sum('monto');
    }

}

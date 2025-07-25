<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ResponsablesIndicador extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'responsables_indicador';
    public $timestamps = false;
    protected $fillable = [
        'id_indicador',
        'id_responsable',
    ];

    public static function creaRegistro($data)
    {
        return ResponsablesIndicador::create([
            'id_indicador' => $data['id_indicador'],
            'id_responsable' => $data['id_responsable'],
        ]);
    }
    
    public function responsable(){
        return $this->belongsTo('App\Models\Responsables','id_responsable','id')->first();
    }
    
    public function responsables($idS){
        return Responsables::where('id_secretaria',$idS)->pluck('nombre','id');
        
    }
    
}

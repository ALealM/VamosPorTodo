<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ResponsablesProyecto extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'responsables_proyecto';
    public $timestamps = false;
    protected $fillable = [
        'id_accion',
        'id_responsable',
    ];

    public static function creaRegistro($data)
    {
        return ResponsablesProyecto::create([
            'id_accion' => $data['id_accion'],
            'id_responsable' => $data['id_responsable'],
        ]);
    }
    
    public function responsable(){
        return $this->belongsTo('App\Models\Responsables','id_responsable','id')->first();
    }
    
}

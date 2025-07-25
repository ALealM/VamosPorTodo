<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class TipoBeneficiarios extends Model
{ 
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tipo_beneficiarios';
    public $timestamps = false;
    protected $fillable = [
        'tipo',
    ];

    public static function creaRegistro($data)
    {
        return TipoBeneficiarios::create([
            'tipo' => $data['tipo'],
        ]);
    }
    
    public static function editaRegistro($data) {
        $registro= TipoBeneficiarios::find($data['id']);
        $registro->tipo=$data['tipo'];
        $registro->save();
        return true;
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'users';
     public $timestamps = false;
     protected $fillable = [
       'nombre',
       'ap_paterno',
       'ap_materno',
       'correo',
       'password',
       'remember_token',
       'fotografia',
       'tema',
       'estado',
       'tipo',
       'area',
       'director'
     ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function validator($data)
    {
      return Validator::make($data, [
        'nombre' => 'required|max:255',
        'ap_paterno' => 'required|max:255',
        'ap_materno' => 'required|max:255',
        'correo' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
        'fotografia' => 'required|image|mimes:jpeg,bmp,png',
      ]);
    }

    public static function creaRegistro($data) {
      return User::create([
        'nombre' => $data['nombre'],
        'ap_paterno' => $data['ap_paterno'],
        'ap_materno' => $data['ap_materno'],
        'correo' => $data['correo'],
        'password' => \Hash::make($data['password']),
        'fotografia' => $data['fotografia'],
        'tema' => 4,
        'tipo' => $data['tipo'],
        'area' => $data['area'],
        'director' => (@$data['director'] == 'on' ? 1 : 0)
      ]);
    }

    public function getNomCompAttribute () {
      return $this->attributes['nombre']." ".$this->attributes['ap_paterno']." ".$this->attributes['ap_materno'];
    }

    public function nombreCompleto () {
      return $this->attributes['nombre']." ".$this->attributes['ap_paterno']." ".$this->attributes['ap_materno'];
    }

    public function responsable(){
      return $this->belongsTo('App\User','responsable','id')->first();
    }
    
    public function gabinete(){
      return $this->belongsTo('App\Models\Gabinete','id_gabinete','id')->first();
    }
    
    public function dependencia () {
        return $this->belongsTo('App\Models\Gabinete','id_gabinete','id')->first();
    }
    
}

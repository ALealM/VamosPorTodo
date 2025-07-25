<?php

namespace App\Models;

//use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteresadoAgenda extends Model
{
    use HasFactory;//use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'interesado_agenda';
    public $timestamps = false;
    protected $fillable = [
        'id_cat_int',
        'nombre',
    ];
}
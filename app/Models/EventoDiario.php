<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoDiario extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'eventosDiarios';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'fecha_alta',
        'fecha',
        'evento',
        'id_direccion',
    ];
}

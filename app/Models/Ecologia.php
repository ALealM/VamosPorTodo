<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\EcologiaActividades as EA;
use Validator;

class Ecologia extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ecologia';
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'main_image',
        'card1',
        'card2',
        'horizontal_image',
        'title_cards',
        'card3',
        'card4',
        'vertical_image',
        'fecha_init',
        'fecha_end',
        'activo', // 1 -> Si  ;  2 -> No
        'date_alta',
        'id_user',
        'date_update',
        'user_update',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public static function new($data) {
        $registro = Ecologia::create([
            'titulo' => $data['titulo'],
            'card1' => $data['card1'],
            'card2' => $data['card2'],
            'title_cards' => @$data['titulo_cards'],
            'card3' => $data['card3'],
            'card4' => $data['card4'],
            'fecha_init' => $data['fecha_init'],
            'fecha_end' => $data['fecha_fin'],
            'date_alta' => date('Y-m-d H:i:s'),
            'id_user' => \Auth::User()->id
        ]);

        // guardar Imagenes
        $registro->main_image = self::saveImage($data['mainImage'], $registro->id, 1);
        $registro->horizontal_image = self::saveImage($data['image2'], $registro->id, 2);
        $registro->vertical_image = self::saveImage($data['image3'], $registro->id, 3);
        $registro->save();

        foreach ($data['actividades'] as $act) {
            EA::new( [ 'id' => $registro->id, 'act' => $act ] );
        }
        return $registro;
    }

    private static function saveImage($image, $id, $indice){
        $anexo = $id . '-'.$indice.'-' . substr($image->getClientOriginalName(), 0, 80);
        $image->move( public_path() . '/ecologia/', $anexo );
        return $anexo;
    }

    public static function editar($data) {
        $registro= Ecologia::find($data['id']);
        $registro->titulo = $data['titulo'];
        if( @$data['mainImage'] ) $registro->main_image = self::saveImage($data['mainImage'], $registro->id, 1);
        $registro->card1 = $data['card1'];
        $registro->card2 = $data['card2'];
        if( @$data['image2'] ) $registro->horizontal_image = self::saveImage($data['image2'], $registro->id, 2);
        $registro->title_cards = @$data['titulo_cards'];
        $registro->card3 = $data['card3'];
        $registro->card4 = $data['card4'];
        if( @$data['image3'] ) $registro->vertical_image = self::saveImage($data['image3'], $registro->id, 3);
        $registro->fecha_init = $data['fecha_init'];
        $registro->fecha_end = $data['fecha_fin'];
        $registro->date_update = date('Y-m-d H:i:s');
        $registro->user_update = \Auth::User()->id;
        $registro->save();
        EA::where('id_ecologia', $data['id'])->delete();
        foreach ($data['actividades'] as $act) {
            EA::new( [ 'id' => $registro->id, 'act' => $act ] );
        }
        return true;
    }
}
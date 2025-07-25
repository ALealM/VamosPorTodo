<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use App\Models\EjesRectores as ER;
use App\Models\Gabinete;
use App\Models\GruposObjetivo as GO;
use App\Models\MediosComunicacion as MC;
use App\Models\InvitadosAgenda as IA;
use App\Models\Riesgos;
use App\Models\InteresadoAgenda as IntAg;

class Agenda extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'agenda';
    public $timestamps = false;
    protected $fillable = [
        'folio',
        'meta',
        'solucion',
        'ubicacion',
        'titulo_evento',
        'contenido_presentacion',
        'fecha_alta',
        'id_usuario',
        'fecha_update',
        'user_update',
    ];

    private static function otherTables($id, $data){
        // ejes
        if( @$data['eje'] )
            foreach ($data['eje'] as $value) {
                \DB::insert('insert into agenda_enfoque (id_agenda, tabla_provienen, id_enfoque) values (?, ?, ?)', [$id, 1, $value]);
            }

        // Gabinetes
        foreach (@$data['direcciones'] as $value) {
            \DB::insert('insert into agenda_enfoque (id_agenda, tabla_provienen, id_enfoque) values (?, ?, ?)', [$id, 2, $value]);
        }

        // Grupo Objetivo
        if( @$data['go'] )
            foreach ($data['go'] as $value) {
                \DB::insert('insert into agenda_enfoque (id_agenda, tabla_provienen, id_enfoque, otro) values (?, ?, ?, ?)', [$id, 3, $value, @$data['otros'.$value]]);
            }

        // Medios de Comunicación
        if( @$data['mc'] )
            foreach (@$data['mc'] as $value) {
                \DB::insert('insert into agenda_enfoque (id_agenda, tabla_provienen, id_enfoque, otro) values (?, ?, ?, ?)', [$id, 4, $value, @$data['otrosMc'.$value]]);
            }

        if (@$data['otrosMc18']) {
            \DB::insert('insert into agenda_enfoque (id_agenda, tabla_provienen, id_enfoque, otro) values (?, ?, ?, ?)', [$id, 4, 18, $data['otrosMc18']]);
        }

        // Invitados
        if( @$data['ia'] )
            foreach ($data['ia'] as $value) {
                \DB::insert('insert into agenda_enfoque (id_agenda, tabla_provienen, id_enfoque, otro) values (?, ?, ?, ?)', [$id, 5, $value, @$data['otrosInv'.$value]]);
            }

        // Matriz de riesgos
        for ( $i = 1; $i <= Riesgos::all()->count(); $i++ ) {
            if( @$data['riesgo'.$i ])
                \DB::insert('insert into agenda_matriz_riesgo (id_agenda, tipo_matriz, id_riesgo, cumple, plan_accion) values (?, ?, ?, ?, ?)', [$id, 1, $i, @$data['riesgo'.$i], @$data['riesgoPlan'.$i]]);
            if( @$data['mitRiesgo'.$i] )
                \DB::insert('insert into agenda_matriz_riesgo (id_agenda, tipo_matriz, id_riesgo, cumple, plan_accion) values (?, ?, ?, ?, ?)', [$id, 2, $i, @$data['mitRiesgo'.$i], @$data['mitRiesgoPlan'.$i]]);
        }

        // Interesados
        foreach ($data['interesado'] as $key => $value) {
            if($value)
                \DB::insert('insert into agenda_gestion_interesado (id_agenda, id_interesado, poder, interes, tipo) values (?, ?, ?, ?, ?)', [ $id, $value, $data['poder'][$key], $data['interes'][$key], $data['tip'][$key] ]);
        }
    }

    public static function newRegistro($data) {
        $agendaCreate = Agenda::create([
            'folio' => date('Y-m-d').'-'.substr(str_shuffle('123456789abcdefghijkmnpqrstuvwxyz'), 0, 5),
            'meta' => $data['meta'],
            'solucion' => $data['solucion'],
            'ubicacion' => $data['ubicacion'],
            'titulo_evento' => $data['titulo'],
            'contenido_presentacion' => $data['contenido'],
            'fecha_alta' => date('Y-m-d H:i:s'),
            'id_usuario' => \Auth::User()->id,
        ]);

        self::otherTables($agendaCreate->id, $data);

        return $agendaCreate;
    }

    public static function getAgenda($id){
        $registros = Agenda::find($id);
        $registros->enfoques = \DB::table('agenda_enfoque')->where('id_agenda', $registros['id'])->orderBy('tabla_provienen')->orderBy('id_enfoque')->get();
        $registros->riesgos = \DB::table('agenda_matriz_riesgo')->where('id_agenda', $registros['id'])->orderBy('tipo_matriz')->get();
        $registros->interesados = \DB::table('agenda_gestion_interesado')->where('id_agenda', $registros['id'])->get();
        foreach ($registros->interesados as $value) {
            $value->depto = IntAg::where('id', $value->id_interesado)->value('nombre');
        }
        //dd($registros->interesados,$registros->interesados[0]->poder);
        return $registros;
    }

    public static function getRegistroAgenda($id){
        $agenda = Agenda::find($id);
        $enfoques = \DB::table('agenda_enfoque')->where('id_agenda', $agenda['id'])->get();
        $countEjes = $countGab = $countGO = $countMC = $countInvit = 0;
        foreach ($enfoques as $enfoque) {
            switch( $enfoque->tabla_provienen ){
                case 1: // ejes
                    $tempEjes[$countEjes] = ER::where('id', $enfoque->id_enfoque)->first();
                    $tempEjes[$countEjes]->otro = $enfoque->otro;
                    $countEjes++;
                    break;
                case 2: // Gabinetes
                    $tempGab[$countGab]['gabinete'] = Gabinete::where('id', $enfoque->id_enfoque)->value('direccion');
                    $tempGab[$countGab]['otro'] = $enfoque->otro;
                    $countGab++;
                    break;
                case 3: // Grupo Objetivo
                    $tempGO[$countGO] = GO::where('id', $enfoque->id_enfoque)->first();
                    $tempGO[$countGO]->otro = $enfoque->otro;
                    $countGO++;
                    break;
                case 4: // Medios de Comunicación
                    $tempMC[$countMC] = MC::where('id', $enfoque->id_enfoque)->first();
                    $tempMC[$countMC]->otro = $enfoque->otro;
                    $countMC++;
                    break;
                case 5: // Invitados
                    $tempInvit[$countInvit] = IA::where('id', $enfoque->id_enfoque)->first();
                    $tempInvit[$countInvit]->otro = $enfoque->otro;
                    $countInvit++;
                    break;
            }
        }
        $agenda->ejes = $tempEjes;
        $agenda->gabinetes = $tempGab;
        $agenda->grupObjet = $tempGO;
        $agenda->medCom = $tempMC;
        $agenda->invitados = @$tempInvit ? $tempInvit : [];
        $agenda->riesgos = \DB::table('agenda_matriz_riesgo')->where('id_agenda', $agenda['id'])->orderBy('tipo_matriz')->get();
        foreach ($agenda->riesgos as $risk) {
            $risk->riesgo = Riesgos::where('id',$risk->id_riesgo)->value('riesgo');
        }
        $agenda->interesados = \DB::table('agenda_gestion_interesado')->where('id_agenda', $agenda['id'])->get();
        foreach ($agenda->interesados as $intdo) {
            $intdo->depto = IntAg::where('id', $intdo->id_interesado)->value('nombre');
        }
        return $agenda;
    }

    public static function editaRegistro($data){
        $registro = Agenda::find($data['id_agenda']);
        $registro->meta = $data['meta'];
        $registro->solucion = $data['solucion'];
        $registro->ubicacion = $data['ubicacion'];
        $registro->titulo_evento = $data['titulo'];
        $registro->contenido_presentacion = $data['contenido'];
        $registro->fecha_update = date('Y-m-d H:i:s');
        $registro->user_update = \Auth::User()->id;
        $registro->save();
        \DB::table('agenda_enfoque')->where('id_agenda', $data['id_agenda'])->delete();
        \DB::table('agenda_matriz_riesgo')->where('id_agenda', $data['id_agenda'])->delete();
        \DB::table('agenda_gestion_interesado')->where('id_agenda', $data['id_agenda'])->delete();
        self::otherTables($data['id_agenda'], $data);
        return true;
    }
}
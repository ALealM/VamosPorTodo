<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\AccionesAc;
use App\Models\UnidadesAc;
use App\Models\AreasAc;
use App\Models\Avances;
use Illuminate\Support\Facades\Session;
use Redirect;
use Barryvdh\DomPDF\Facade as PDF;

class LineasAccionController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function panel() {
        $areas = AreasAc::all();
        $acciones[1] = AccionesAc::where('id_area',102)->get();
         $acciones[2] = AccionesAc::where('id_area',103)->get();
         $acciones[3] = AccionesAc::where('id_area',104)->get();
         $acciones[4] = AccionesAc::where('id_area',105)->get();
         $acciones[5] = AccionesAc::where('id_area',106)->get();
         $acciones[6] = AccionesAc::where('id_area',107)->get();
         return view('panelAc.index', [
             'aBreadCrumb' => [['link' => 'active', 'label' => 'Panel']],
             'sTitulo' => 'Panel',
             'sDescripcion' => 'Panel',
             'acciones' => $acciones,
             'areas' => $areas,
         ]);
     }

     public function getAccion(Request $request) {
         $id = $request->get('id');
         $acc = AccionesAc::find($id);
         $avance = Avances::where('id_accion',$id)->sum('avance');
         $acc->avance = $avance*1;
         $acc->faltante = $acc->meta - $avance;
         $acc->unidad = $acc->unidad()->unidad;
         if($acc->id_unidad == 6){
           $acc->meta_ = "$ ".number_format($acc->meta,2,".",",");
           $acc->avance_ = "$ ".number_format($avance,2,".",",");
           $acc->unidad = 'Pesos';
         }
         elseif($acc->id_unidad == 14){
           $acc->meta_ = $acc->meta ."%";
           $acc->avance_ = $avance ."%";
           $acc->unidad = 'Porciento';
         }
         else{
           $acc->meta_ = number_format($acc->meta) ." ". $acc->unidad()->unidad;
           $acc->avance_ = number_format($avance) ." ". $acc->unidad()->unidad;
         }
         return $acc;
     }

    public function listado() {
        $acciones = AccionesAc::all();
        return view('lineasAccion.index', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Listado de líneas de acción']],
            'sTitulo' => 'Líneas de Acción',
            'sDescripcion' => 'Líneas de Acción',
            'acciones' => $acciones
        ]);
    }

    public function create() {
        $acciones = AccionesAc::all();
        $direcciones = AreasAc::pluck('direccion','id');
        $unidades = UnidadesAc::pluck('unidad','id');
        return view('lineasAccion.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta línea acción']],
            'sTitulo' => 'Líneas de Acción',
            'sDescripcion' => 'Alta de nueva línea de acción',
            'acciones' => $acciones,
            'unidades' => $unidades,
            'direcciones' => $direcciones
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();

        $acc = AccionesAc::creaRegistro($input);

        if ($acc) {
            $accion = 'Creación de nueva línea de acción: ' . $acc->id;

            Bitacora::creaRegistro($accion);
            Session::flash('tituloMsg', 'Guardado exitoso!');
            Session::flash('mensaje', "Se ha creado exitosamente la nueva línea de acción.");
            Session::flash('tipoMsg', 'success');
        } else {
            Session::flash('tituloMsg', 'Guardado fallido!');
            Session::flash('mensaje', "No se ha podido guardar la nueva línea de acción.");
            Session::flash('tipoMsg', 'error');
        }
        return Redirect::to('lineasAccion');
    }

    public function avance($id) {
        $accion = AccionesAc::find($id);
        $avances = Avances::where('id_accion',$id)->get();
        return view('lineasAccion.avances', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Avances de línea de acción']],
            'sTitulo' => 'Registro de avances',
            'sDescripcion' => 'Avances de línea de acción',
            'accion' => $accion,
            'avances' => $avances
        ]);
    }

    public function storeAvances(Request $request) {
        $input = $request->all();
        // dd($input);
        $i=0;
        foreach($input['avId'] as $avId){
            $data['id'] = $avId;
            $data['avance'] = $input['avance'][$i];
            Avances::editaRegistro($data);
            $i++;
        }
        $accion = 'Registro de avances de línea de acción: ' . $input['id'];
        Bitacora::creaRegistro($accion);
        Session::flash('tituloMsg', 'Guardado exitoso!');
        Session::flash('mensaje', "Se ha guardado exitosamente el avance de la línea de acción.");
        Session::flash('tipoMsg', 'success');
        return Redirect::to('lineasAccion');
    }

    public function pdf($id) {
        $area = AreasAc::find($id);
        $acciones = AccionesAc::where('id_area',$id)->get();
        foreach($acciones as $acc){
          $avance = Avances::where('id_accion',$acc->id)->sum('avance');
          // $acc->avance = $avance*1;
          // $acc->faltante = $acc->meta - $avance;
          if($acc->id_unidad == 6){
            $acc->meta = "$ ".number_format($acc->meta,2,".",",");
            $acc->avance = "$ ".number_format($avance,2,".",",");
          }
          elseif($acc->id_unidad == 14){
            $acc->meta = $acc->meta ."%";
            $acc->avance = $avance ."%";
          }
          else{
            $acc->meta = number_format($acc->meta) ." ". $acc->unidad()->unidad;
            $acc->avance = number_format($avance) ." ". $acc->unidad()->unidad;
          }
        }
        return PDF::loadView('lineasAccion.pdf', compact('area', 'acciones'))->download("Líneas de acción de $area->area.pdf");
    }

}

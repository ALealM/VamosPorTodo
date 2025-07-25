<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quincenas;
use App\Models\Nomina;
use App\Models\DireccionesN;
use App\Models\DepartamentosN;
use App\Models\PuestosN;
use Illuminate\Support\Facades\Session;
use Redirect;
use App\Http\Controllers\SistemaController;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Schema;

class NominaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function consulta() {
        $quincenas = Quincenas::where('carga',1)->pluck('descripcion','id');
        $direcciones = DireccionesN::all()->pluck('cveDir','id');
        $departamentos = DepartamentosN::all()->pluck('cveDep','id');
        $puestos = PuestosN::select('id','puesto')->orderBy('puesto')->pluck('puesto','id');
        $orden = ['0'=>'Sin ordenamiento','1'=>'Por Dirección','2'=>'Por Departamento','3'=>'Por Puesto','4'=>'Por de Fecha de ingreso','5'=>'Por de Fecha de ingreso (Descendente)','6'=>'Por Sueldo','7'=>'Por Sueldo (Descendente)'];
        return view('nomina.consulta',[
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Consulta Nómina Quincenal']],
            'sTitulo' => 'Consulta Nómina Quincenal',
            'sDescripcion' => 'Consulta de Nómina Quincenal',
            'quincenas' => $quincenas,
            'direcciones' => $direcciones,
            'departamentos' => $departamentos,
            'puestos' => $puestos,
            'orden' => $orden,
        ]);
    }

    public function carga() {
        $quincenas = Quincenas::all();
        return view('nomina.carga',[
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Carga Nómina Quincenal']],
            'sTitulo' => 'Carga Nómina Quincenal',
            'sDescripcion' => 'Carga de layout de Nómina Quincenal',
            'quincenas' => $quincenas
        ]);
    }

    public function subir(Request $request)
    {
        set_time_limit(0);
        $input=$request->all();
        $quincena = Quincenas::find($input['quincena']);
        $nomina = $input['nomina'];
        $ext = $nomina->getClientOriginalExtension();
        $nombre = "$quincena->descripcion $quincena->anio.$ext";
        $nomina->move(public_path() . '/archivos/nominas/', $nombre);
        $quincena->carga = 1;
        $quincena->archivo = $nombre;
        $quincena->fecha_carga = date('Y-m-d H:i:s');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load("archivos/nominas/$nombre");
        $rows = $spreadsheet->getActiveSheet()->getHighestRow('A');
        $r=2;
        while($r<=$rows){
            $data['cve_direccion'] = $spreadsheet->getActiveSheet()->getCell("A$r")->getValue();
            $data['direccion'] = $spreadsheet->getActiveSheet()->getCell("B$r")->getValue();
            $data['cve_depto'] = $spreadsheet->getActiveSheet()->getCell("C$r")->getValue();
            $data['departamento'] = $spreadsheet->getActiveSheet()->getCell("D$r")->getValue();
            $data['cve_nomina'] = $spreadsheet->getActiveSheet()->getCell("J$r")->getValue();
            $data['tipo_nomina'] = $spreadsheet->getActiveSheet()->getCell("K$r")->getValue();
            $data['ap_paterno'] = $spreadsheet->getActiveSheet()->getCell("L$r")->getValue();
            $data['ap_materno'] = $spreadsheet->getActiveSheet()->getCell("M$r")->getValue();
            $data['nombre'] = $spreadsheet->getActiveSheet()->getCell("N$r")->getValue();
            $data['sexo'] = $spreadsheet->getActiveSheet()->getCell("P$r")->getValue();
            $data['cve_puesto'] = $spreadsheet->getActiveSheet()->getCell("S$r")->getValue();
            $data['puesto'] = $spreadsheet->getActiveSheet()->getCell("T$r")->getValue();
            $fecha_1 = $spreadsheet->getActiveSheet()->getCell("U$r")->getValue();
            $fecha_ingreso = $spreadsheet->getActiveSheet()->getCell("V$r")->getValue();
            $data['tipo_contrato'] = $spreadsheet->getActiveSheet()->getCell("X$r")->getValue();
            $fecha_inicial = $spreadsheet->getActiveSheet()->getCell("Y$r")->getValue();
            $fecha_final = $spreadsheet->getActiveSheet()->getCell("Z$r")->getValue();
            $data['sueldo_diario'] = $spreadsheet->getActiveSheet()->getCell("AA$r")->getValue();
            $data['sueldo_mensual'] = $spreadsheet->getActiveSheet()->getCell("AB$r")->getValue();
            $data['rfc'] = $spreadsheet->getActiveSheet()->getCell("AH$r")->getValue();
            $data['domicilio'] = $spreadsheet->getActiveSheet()->getCell("AI$r")->getValue();
            $data['colonia'] = $spreadsheet->getActiveSheet()->getCell("AJ$r")->getValue();
            $data['cp'] = $spreadsheet->getActiveSheet()->getCell("AK$r")->getValue();
            $data['telefono'] = $spreadsheet->getActiveSheet()->getCell("AL$r")->getValue();
            $data['curp'] = $spreadsheet->getActiveSheet()->getCell("AR$r")->getValue();
            $fecha_nacimiento = $spreadsheet->getActiveSheet()->getCell("AS$r")->getValue();
            $data['ispt'] = $spreadsheet->getActiveSheet()->getCell("AT$r")->getValue();
            $data['neto_pagar'] = $spreadsheet->getActiveSheet()->getCell("CM$r")->getValue();
            $data['total'] = $spreadsheet->getActiveSheet()->getCell("CO$r")->getCalculatedValue();
            $data['id_quincena'] = $input['quincena'];
            if(is_numeric($fecha_1)){ $f1 = ($fecha_1 - 25569) * 86400; $data['fecha_1'] = gmdate("Y-m-d", $f1); }
            else{ $data['fecha_1'] = null; }
            if(is_numeric($fecha_ingreso)){ $fing = ($fecha_ingreso - 25569) * 86400; $data['fecha_ingreso'] = gmdate("Y-m-d", $fing); }
            else{ $data['fecha_ingreso'] = null; }
            if(is_numeric($fecha_inicial)){ $fini = ($fecha_inicial - 25569) * 86400; $data['fecha_inicial'] = gmdate("Y-m-d", $fini); }
            else{ $data['fecha_inicial'] = null; }
            if(is_numeric($fecha_final)){ $ffin = ($fecha_final - 25569) * 86400; $data['fecha_final'] = gmdate("Y-m-d", $ffin); }
            else{ $data['fecha_final'] = null; }
            if(is_numeric($fecha_nacimiento)){ $fnac = ($fecha_nacimiento - 25569) * 86400; $data['fecha_nacimiento'] = gmdate("Y-m-d", $fnac); }
            else{ $data['fecha_nacimiento'] = null; }
            Nomina::creaRegistro($data);
            $r++;
        }
        $quincena->save();
        Session::flash('tituloMsg', 'Guardado extoso!');
        Session::flash('mensaje', "Se ha cargado correctamente el archivo de nómina.");
        Session::flash('tipoMsg', 'success');
        return Redirect::to('cargaNomina');
    }

    public function buscar(Request $request) {
        $q = $request->get('q');
        $qPrim = Quincenas::whereNotNull('archivo')->first()->id;
        $dir = $request->get('dir');
        if($dir==''){$dir = " ";}else{$dr = DireccionesN::find($dir)->cve_direccion; $dir = " and cve_direccion = $dr ";}
        $dep = $request->get('dep');
        if($dep==''){$dep = " ";}else{$dp = DepartamentosN::find($dep)->cve_depto; $dep = " and cve_depto = $dp ";}
        $p = $request->get('p');
        if($p==''){$p = " ";}else{$pu = PuestosN::find($p)->cve_puesto; $p = " and cve_puesto = $pu ";}
        $fi = $request->get('fi');
        $ff = $request->get('ff');
        if($fi=='' && $ff==''){ $fechas = ' ';}
        elseif($fi!='' && $ff!=''){ $fechas = " and fecha_ingreso between '$fi 00:00:00' and '$ff 23:59:59' ";}
        elseif($fi==''){ $fechas = " and fecha_ingreso between '1900-01-01' and '$ff 23:59:59' ";}
        elseif($ff==''){ $fechas = " and fecha_ingreso between '$fi 00:00:00' and '".date('Y')."-12-31 23:59:59' ";}
        $ord = $request->get('ord');
        switch ($ord){
            case 0: $ord = " "; break;
            case 1: $ord = " order by direccion "; break;
            case 2: $ord = " order by departamento "; break;
            case 3: $ord = " order by puesto "; break;
            case 4: $ord = " order by fecha_ingreso "; break;
            case 5: $ord = " order by fecha_ingreso DESC"; break;
            case 6: $ord = " order by sueldo_mensual "; break;
            case 7: $ord = " order by sueldo_mensual DESC"; break;
        }
        $pen = $request->get('pen');
        if($pen==2){$pen = " ";}else{$pen = " and cve_puesto not in (4110,3066,4107,5057,4108,5058,4109) ";}
        $nomina = \DB::select( \DB::raw("select * from nomina where id_quincena = $q $dir $dep $p $fechas $pen $ord"));
        $nominaG = \DB::select( \DB::raw("select sum(sueldo_mensual) sueldo, direccion, cve_direccion from nomina where id_quincena = $q $fechas $pen group by direccion, cve_direccion order by cve_direccion"));
        $totG = 0;
        foreach($nominaG as $ng){
            $totG+=$ng->sueldo;
        }
        if($q == $qPrim){
            $altas = 0;
            $bajas = 0;
            $altasD = 0;
            $bajasD = 0;
        }
        else{
            $q1 = Quincenas::whereNotNull('archivo')->whereNotin('id',[$q])->orderBy('id','desc')->first()->id;
            $altas = \DB::select( \DB::raw("select count(*) tot from nomina where id_quincena = $q and cve_nomina not in (select cve_nomina from nomina where id_quincena = $q1)"))[0]->tot;
            $bajas = \DB::select( \DB::raw("select count(*) tot from nomina where id_quincena = $q1 and cve_nomina not in (select cve_nomina from nomina where id_quincena = $q)"))[0]->tot;
            $altasD = \DB::select( \DB::raw("select count(*) tot from nomina where id_quincena = $q and cve_nomina not in (select cve_nomina from nomina where id_quincena = $q1 $dir) $dir"))[0]->tot;
            $bajasD = \DB::select( \DB::raw("select count(*) tot from nomina where id_quincena = $q1 and cve_nomina not in (select cve_nomina from nomina where id_quincena = $q $dir) $dir"))[0]->tot;
        }
        $direcciones = DireccionesN::all()->pluck('cveDir','cve_direccion');
        return view('nomina.table',[
            'nomina' => $nomina,
            'nominaG' => $nominaG,
            'direcciones' => $direcciones,
            'totG' => $totG,
            'altas' => $altas,
            'bajas' => $bajas,
            'altasD' => $altasD,
            'bajasD' => $bajasD
        ]);
    }

    public function excel(Request $request)
    {
//        dd($request->all());
        $q = $request->get('quincena');
        $dir = $request->get('direccion');
        if($dir==''){$dir = " ";}else{$dr = DireccionesN::find($dir)->cve_direccion; $dir = " and cve_direccion = $dr ";}
        $dep = $request->get('depto');
        if($dep==''){$dep = " ";}else{$dp = DepartamentosN::find($dep)->cve_depto; $dep = " and cve_depto = $dp ";}
        $p = $request->get('puesto');
        if($p==''){$p = " ";}else{$pu = PuestosN::find($p)->cve_puesto; $p = " and cve_puesto = $pu ";}
        $fi = $request->get('fecha_i');
        $ff = $request->get('fecha_f');
        if($fi=='' && $ff==''){ $fechas = ' ';}
        elseif($fi!='' && $ff!=''){ $fechas = " and fecha_ingreso between '$fi 00:00:00' and '$ff 23:59:59' ";}
        elseif($fi==''){ $fechas = " and fecha_ingreso between '1900-01-01' and '$ff 23:59:59' ";}
        elseif($ff==''){ $fechas = " and fecha_ingreso between '$fi 00:00:00' and '".date('Y')."-12-31 23:59:59' ";}
        $ord = $request->get('orden');
        switch ($ord){
            case 0: $ord = " "; break;
            case 1: $ord = " order by direccion "; break;
            case 2: $ord = " order by departamento "; break;
            case 3: $ord = " order by puesto "; break;
            case 4: $ord = " order by fecha_ingreso "; break;
            case 5: $ord = " order by fecha_ingreso DESC"; break;
            case 6: $ord = " order by sueldo_mensual "; break;
            case 7: $ord = " order by sueldo_mensual DESC"; break;
        }
        $pen = $request->get('pensionados');
        if($pen==2){$pen = " ";}else{$pen = " and cve_puesto not in (4110,3066,4107,5057,4108,5058,4109) ";}
        $nomina = \DB::select( \DB::raw("select * from nomina where id_quincena = $q $dir $dep $p $fechas $pen $ord"));
//        dd($nomina);
        ///////###################  GENERA EXCEL
//        $spreadsheet = new Spreadsheet();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load("plantillasExcel/Nomina.xlsx");
        $sheet = $spreadsheet->getActiveSheet();
        $r=2;
        foreach($nomina as $nom){
            $sheet->setCellValue("A$r", "$nom->nombre $nom->ap_paterno $nom->ap_materno");
            $sheet->getStyle("B$r")->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
            $fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($nom->fecha_ingreso );
            $sheet->setCellValue("B$r", $fecha);
            $sheet->setCellValue("C$r", $nom->sueldo_diario);
            $sheet->setCellValue("D$r", $nom->sueldo_mensual);
            $sheet->setCellValue("E$r", $nom->direccion);
            $sheet->setCellValue("F$r", $nom->departamento);
            $sheet->setCellValue("G$r", $nom->puesto);
            $r++;
        }
        $x = $r-2;
        $spreadsheet->getActiveSheet()->setAutoFilter("A1:G$x");
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment;filename="Reporte de Nómina '.date('d-m-Y').'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

     public function getDeptos(Request $request) {
        $dir = $request->get('dir');
        if($dir == '')
        $deptos = DepartamentosN::all();
        else
        $deptos = DepartamentosN::where('id_direccion',$dir)->get();
        return $deptos;
    }

    public function altasBajas() {
        $quincenas = Quincenas::where('carga',1)->pluck('descripcion','id');
        return view('nomina.altasBajas',[
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Consulta Nómina Cambios/Altas/Bajas']],
            'sTitulo' => 'Consulta Nómina Cambios/Altas/Bajas',
            'sDescripcion' => 'Consulta de Cambios de Nómina, Altas y Bajas entre quincenas',
            'quincenas' => $quincenas
        ]);
    }

    public function buscarAB(Request $request) {
        $q1 = $request->get('q1');
        $q2 = $request->get('q2');

        $altas = \DB::select( \DB::raw("select * from nomina where id_quincena = $q2 and cve_nomina not in (select cve_nomina from nomina where id_quincena = $q1)"));
        $bajas = \DB::select( \DB::raw("select * from nomina where id_quincena = $q1 and cve_nomina not in (select cve_nomina from nomina where id_quincena = $q2)"));
        $cambios = \DB::select( \DB::raw("select n1.cve_nomina, n1.nombre, n1.ap_paterno, n1.ap_materno, n1.sueldo_mensual sm1, n2.sueldo_mensual sm2, n2.fecha_ingreso, n1.direccion di1,
        n1.departamento de1, n1.puesto p1, n2.direccion di2, n2.departamento de2, n2.puesto p2, n1.cve_direccion dir1, n2.cve_direccion dir2, n1.cve_depto dto1, n2.cve_depto dto2,
        n1.cve_puesto pto1, n2.cve_puesto pto2 from nomina n1 inner join nomina n2 on n1.cve_nomina = n2.cve_nomina and n1.id_quincena = $q1 and n2.id_quincena = $q2 and n1.tipo_nomina = n2.tipo_nomina
        and (n1.sueldo_mensual <> n2.sueldo_mensual or n1.cve_direccion <> n2.cve_direccion or n1.cve_depto <> n2.cve_depto or n1.cve_puesto <> n2.cve_puesto)"));
        foreach($cambios as $cambio){
            $cambio->cambios = '';
            if($cambio->sm1 != $cambio->sm2) $cambio->cambios .= "Sueldo de $".number_format($cambio->sm1,2,".",",")." a $".number_format($cambio->sm2,2,".",",")."<br>";
            if($cambio->dir1 != $cambio->dir2) $cambio->cambios .= "Dirección de $cambio->di1 a $cambio->di2<br>";
            if($cambio->dto1 != $cambio->dto2) $cambio->cambios .= "Departamento de $cambio->de1 a $cambio->de2<br>";
            if($cambio->pto1 != $cambio->pto2) $cambio->cambios .= "Puesto de $cambio->p1 a $cambio->p2.";
        }

        return view('nomina.tableAB',[
            'altas' => $altas,
            'bajas' => $bajas,
            'cambios' => $cambios,
        ]);
    }

    public function getGrafica(Request $request) {
        $dir = $request->get('dir');
        $di='';
        if($dir != []){
            foreach($dir as $d){
                $di.="$d,";
            }
        }
        $di.=0;
        $q = $request->get('q');
        $fi = $request->get('fi');
        $ff = $request->get('ff');
        if($fi=='' && $ff==''){ $fechas = ' ';}
        elseif($fi!='' && $ff!=''){ $fechas = " and fecha_ingreso between '$fi 00:00:00' and '$ff 23:59:59' ";}
        elseif($fi==''){ $fechas = " and fecha_ingreso between '1900-01-01' and '$ff 23:59:59' ";}
        elseif($ff==''){ $fechas = " and fecha_ingreso between '$fi 00:00:00' and '".date('Y')."-12-31 23:59:59' ";}
        $pen = $request->get('pen');
        if($pen==2){$pen = " ";}else{$pen = " and cve_puesto not in (4110,3066,4107,5057,4108,5058,4109) ";}
        $nominaG = \DB::select( \DB::raw("select sum(sueldo_mensual) sueldo, direccion from nomina where id_quincena = $q and cve_direccion not in ($di) $fechas $pen group by direccion"));
        $nominaTot = \DB::select( \DB::raw("select sum(sueldo_mensual) sueldo from nomina where id_quincena = $q $fechas $pen"));
        $totG = $nominaTot[0]->sueldo;
        return view('nomina.grafica',[
            'nominaG' => $nominaG,
            'totG' => $totG
        ]);
    }
}

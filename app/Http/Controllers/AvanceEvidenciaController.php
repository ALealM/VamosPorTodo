<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bitacora;
use App\Models\Acuerdos;
use App\Models\Avance;
use App\Models\Archivo;
use App\Models\Dependencias;
use App\Models\Gabinete;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Blade;
use VendorPackage\View\Components\AlertComponent;
    
    

class AvanceEvidenciaController extends Controller {

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
    $this->middleware('auth');
  }
    

    

  public function index() {
    return view('peticion.avance_evidencia.index', [//000
      'aBreadCrumb' => [['link' => 'active', 'label' => 'Avance']],
    ]);
  }
    
  
  public function avanceevidenciaCreate() {
        return view('peticion.avance_evidencia.create', [
            'aBreadCrumb' => [['link' => 'active', 'label' => 'Alta nuevo avance']],
        ]);
    }


}

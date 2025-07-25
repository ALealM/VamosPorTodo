@if(\Auth::User()->tipo == 1)
<div class="tab-container" style="padding-bottom: 0px">
    <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item btn btn-warning" style="padding: 0px; margin: 0px" id='liPend'>
            <a class="nav-link active" data-toggle="tab" href="#pendientes" role="tab" aria-expanded="true" onclick="cambio(1)" id='aPend'>Pendientes</a>
        </li>
        <li class="nav-item btn btn-outline-info" style="padding: 0px; margin: 0px" id='liRev'>
            <a class="nav-link" data-toggle="tab" href="#revision" role="tab" aria-expanded="false" style="color:#000 !important" onclick="cambio(2)" id='aRev'>En Revisión</a>
        </li>
        <li class="nav-item btn btn-outline-danger" style="padding: 0px; margin: 0px" id='liNA'>
            <a class="nav-link" data-toggle="tab" href="#noautorizados" role="tab" aria-expanded="false" style="color:#000 !important" onclick="cambio(3)" id='aNA'>No Autorizados</a>
        </li>
    </ul>

    <div class="tab-content" style="padding-bottom: 2px">
        <div class="tab-pane fade active show" id="pendientes" role="tabpanel" aria-expanded="true">
            <table class="table tile table-hover  dataTable" role='grid' id="data-table">
                <thead>
                    <tr>
                        <th style=" width: 30px">#</th>
                        <th>Fecha</th>
                        <th>Dirección</th>
                        <th>Lugar</th>
                        <th>Título</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!--0 eliminados
                    1 oficilia
                    2 inventario-->
                    @php $i=1 @endphp
                    @foreach($eventos['p'] as $eventoP)
                    <tr>
                        <td>{!! $i !!}</td>
                        <td>{!! date( 'd/m/Y', strtotime($eventoP->fecha) ) !!}</td>
                        <td>{!! $eventoP->user()->gabinete()->direccion !!}</td>
                        <td>{!! $eventoP->lugar !!}</td>
                        <td>{!! str_replace("\n", "<br>", $eventoP->titulo) !!}</td>
                        <td class="text-center">
                            <div class="btn-group m-0" role="group">
                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu">                        
                                    <a href="{{url('/evento/observaciones/'.$eventoP->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-check-circle mr-2"></i>Revisión</a>        
                                    <a class="col-12 btn btn-secondary btn-sm" onclick="eventoPDF({!! $eventoP->id !!})" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="revision" role="tabpanel" aria-expanded="false">
            <table class="table tile table-hover dataTable " role='grid' id="data-table">
                <thead>
                    <tr>
                        <th style=" width: 30px">#</th>
                        <th>Fecha</th>
                        <th>Dirección</th>
                        <th>Lugar</th>
                        <th>Título</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!--0 eliminados
                    1 oficilia
                    2 inventario-->
                    @php $i=1 @endphp
                    @foreach($eventos['r'] as $eventoR)
                    <tr>
                        <td>{!! $i !!}</td>
                        <td>{!! date( 'd/m/Y', strtotime($eventoR->fecha) ) !!}</td>
                        <td>{!! $eventoR->user()->gabinete()->direccion !!}</td>
                        <td>{!! $eventoR->lugar !!}</td>
                        <td>{!! str_replace("\n", "<br>", $eventoR->titulo) !!}</td>
                        <td class="text-center">
                            <div class="btn-group m-0" role="group">
                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu">                        
                                    <a href="{{url('/evento/observaciones/'.$eventoR->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-check-circle mr-2"></i>Revisión</a>        
                                    <a class="col-12 btn btn-secondary btn-sm" onclick="eventoPDF({!! $eventoR->id !!})" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="noautorizados" role="tabpanel" aria-expanded="false">
            <table class="table tile table-hover  dataTable" role='grid' id="data-table">
                <thead>
                    <tr>
                        <th style=" width: 30px">#</th>
                        <th>Fecha</th>
                        <th>Dirección</th>
                        <th>Lugar</th>
                        <th>Título</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!--0 eliminados
                    1 oficilia
                    2 inventario-->
                    @php $i=1 @endphp
                    @foreach($eventos['na'] as $eventoNA)
                    <tr>
                        <td>{!! $i !!}</td>
                        <td>{!! date( 'd/m/Y', strtotime($eventoNA->fecha) ) !!}</td>
                        <td>{!! $eventoNA->user()->gabinete()->direccion !!}</td>
                        <td>{!! $eventoNA->lugar !!}</td>
                        <td>{!! str_replace("\n", "<br>", $eventoNA->titulo) !!}</td>
                        <td class="text-center">
                            <div class="btn-group m-0" role="group">
                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu">                        
                                    <a href="{{url('/evento/show/'.$eventoNA->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha</a><br>
                                    <a class="col-12 btn btn-secondary btn-sm" onclick="eventoPDF({!! $eventoNA->id !!})" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<table class="table tile table-hover  dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Fecha</th>
            <th>Lugar</th>
            <th>Título</th>
            <th>Estatus</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!--0 eliminados
        1 oficilia
        2 inventario-->
        @php $i=1 @endphp
        @foreach($eventos as $evento)
        <tr>
            <td>{!! $i !!}</td>
            <td>{!! date( 'd/m/Y', strtotime($evento->fecha) ) !!}</td>
            <td>{!! $evento->lugar !!}</td>
            <td>{!! str_replace("\n", "<br>", $evento->titulo) !!}</td>
            <td id='tdEvt{{$evento->id}}'><button class="btn btn-sm btn-{{$evento->estatus==0 ? 'secondary' : ($evento->estatus==1 ? 'warning' : ($evento->estatus==2 ? 'info' : ($evento->estatus==3 ? 'success' : 'danger'))) }}">{!! $evento->estatus() !!}</button></td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        @if(($evento->estatus==0 || $evento->estatus==4) && \Auth::User()->tipo <> 1)
                        <a class="col-12 btn btn-info btn-sm" style="color: white" onclick="eventoEnviar({!! $evento->id !!})" id='btn{{$evento->id}}' ><i class="fa fa-arrow-circle-o-right"></i> Enviar</a><br>
                        <a href="{{url('/evento/edit/'.$evento->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil-square-o mr-2"></i>Editar</a>
                        @endif                        
                        @if(\Auth::User()->tipo == 1 && ($evento->estatus==1 || $evento->estatus==2))
                        <a href="{{url('/evento/observaciones/'.$evento->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-check-circle mr-2"></i>Revisión</a>
                        @endif  
                        @if(\Auth::User()->tipo <> 1 || $evento->estatus==3)
                        <a href="{{url('/evento/show/'.$evento->id)}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha</a><br>
                        @endif
                        <a class="col-12 btn btn-secondary btn-sm" onclick="eventoPDF({!! $evento->id !!})" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>
@endif
<script>
    function cambio(i){
        if(i==1){
            $('#aPend').removeAttr('style');
            $('#liPend').removeClass('btn-outline-warning');
            $('#liPend').addClass('btn-warning');
            
            $('#aRev').removeAttr('style');
            $('#aRev').attr('style','color:#000 !important');
            $('#liRev').removeClass('btn-info');
            $('#liRev').addClass('btn-outline-info');
            
            $('#aNA').removeAttr('style');
            $('#aNA').attr('style','color:#000 !important');
            $('#liNA').removeClass('btn-danger');
            $('#liNA').addClass('btn-outline-danger');
        }
        if(i==2){
            $('#aPend').removeAttr('style');
            $('#aPend').attr('style','color:#000 !important');
            $('#liPend').removeClass('btn-warning');
            $('#liPend').addClass('btn-outline-warning');
            
            $('#aRev').removeAttr('style');
            $('#liRev').removeClass('btn-outline-info');
            $('#liRev').addClass('btn-info');
            
            $('#aNA').removeAttr('style');
            $('#aNA').attr('style','color:#000 !important');
            $('#liNA').removeClass('btn-danger');
            $('#liNA').addClass('btn-outline-danger');
        }
        if(i==3){
            $('#aPend').removeAttr('style');
            $('#aPend').attr('style','color:#000 !important');
            $('#liPend').removeClass('btn-warning');
            $('#liPend').addClass('btn-outline-warning');
            
            $('#aRev').removeAttr('style');
            $('#aRev').attr('style','color:#000 !important');
            $('#liRev').removeClass('btn-info');
            $('#liRev').addClass('btn-outline-info');
            
            $('#aNA').removeAttr('style');
            $('#liNA').removeClass('btn-outline-danger');
            $('#liNA').addClass('btn-danger');
        }
    }
    
</script>
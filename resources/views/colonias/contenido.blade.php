<div class="col-md-12 text-center row">
    <div class="col-md-12">
        <hr>
        <span style="font-size: 20px">Diagnóstico municipal</span> <span style="font-weight: 400; font-size: 20px">{{$colonia->colonia}}</span>
        <br><a onclick="informeCol({{$colonia->id}})" style="color: green; cursor: pointer;" class="btn btn-sm btn-outline-success"><i class="fa fa-download"></i></a>
        <br><br>
    </div>
    @foreach($rubros as $rubro)
    <div class="col-md-4 card" style="margin-top: 15px; margin-bottom: 15px">
        <div class="footer-widget">
            <div class="col-md-12" style=" background-color: {{($rubro->asuntos->isEmpty()) ? '#ff9999' : '#b4d790' }}">
                <h5>{!!(!$rubro->asuntos->isEmpty()) ? '<a onclick="informeColRub('.$colonia->id.','.$rubro->id.')" style="color: green; cursor: pointer;"><i class="fa fa-download"></i></a>' : ''!!}&nbsp;&nbsp;<b>{{ $rubro->nombre }}</b></h5>
            </div>
            <table class="table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <td>
                            <div style="margin-top: 5px; margin-bottom: 15px">
                                <div class="col-md-12">
                                    <ul>
                                        @if($rubro->asuntos->isEmpty())
                                        <li>Sin Asuntos Registrados</li>
                                        @else
                                        @foreach($rubro->asuntos as $asunto)
                                        <li>{{$asunto->asunto}}</li>
                                        @endforeach
                                        @endif                                                                                
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>
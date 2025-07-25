<table class="table tile table-hover dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Sección</th>
            <th>Zona</th>
            <th>Demarcación</th>
            <th>Nombre</th>
            <th>Calle</th>
            <th>Colonia</th>
            <th>C</th>
            <th>Color</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($juntas as $junta)
        @php
            if($junta->color==0){$class="btn-outline-success"; $color = ""; $titulo = "Seleccione...";}           
            if($junta->color==1){$class=""; $color = "background-color: green;color: white"; $titulo = "&nbsp;&nbsp;&nbsp;&nbsp;Verde&nbsp;&nbsp;&nbsp;&nbsp;";}           
            if($junta->color==2){$class=""; $color = "background-color: blue;color: white"; $titulo = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Azul&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}           
            if($junta->color==3){$class=""; $color = "background-color: red;color: white"; $titulo = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rojo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}           
            if($junta->color==4){$class=""; $color = "background-color: yellow; color:black"; $titulo = "&nbsp;Amarillo&nbsp;";}           
            if($junta->color==5){$class=""; $color = "background-image: linear-gradient(to right, red , blue);color: white"; $titulo = "Rojo-Azul";}           
        @endphp
        <tr>
            <td>{!! $i !!}</td>
            <td>{!! $junta->seccion !!}</td>
            <td>{!! $junta->dl !!}</td>
            <td>{!! $junta->demarcacion !!}</td>
            <td>{!! $junta->nombre !!} {!! $junta->ap_paterno !!} {!! $junta->ap_materno !!}</td>
            <td>{!! $junta->calle !!}</td>
            <td>{!! $junta->colonia !!}</td>
            <td>{!! $junta->c1 !!}</td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm {{$class}} dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="{{$color}}" id="btn_{{$junta->id}}">{!!$titulo!!}</button>
                    <div class="dropdown-menu">
                        <a class="col-12 btn btn-sm" onclick="color({!! $junta->id !!},1)" style="background-color: green; color: white"><i class="fa fa-palette"></i>Verde</a><br>
                        <a class="col-12 btn btn-sm" onclick="color({!! $junta->id !!},2)" style="background-color: blue; color: white"><i class="fa fa-palette"></i>Azul</a><br>
                        <a class="col-12 btn btn-sm" onclick="color({!! $junta->id !!},3)" style="background-color: red; color: white"><i class="fa fa-palette"></i>Rojo</a><br>
                        <a class="col-12 btn btn-sm" onclick="color({!! $junta->id !!},4)" style="background-color: yellow"><i class="fa fa-palette"></i>Amarillo</a><br>
                        <a class="col-12 btn btn-sm" onclick="color({!! $junta->id !!},5)" style="background-image: linear-gradient(to right, red , blue); color: white"><i class="fa fa-palette"></i>Rojo-Azul</a><br>
                        <a class="col-12 btn btn-sm" onclick="color({!! $junta->id !!},0)" style="background-color: white"><i class="fa fa-palette"></i>Restaurar</a><br>                        
                    </div>
                </div>
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
</table>            
<div class="card-body ">
    <div class="col-lg-10 col-md-8 ml-auto mr-auto">
        <div style="padding-top: 10px" class="text-center">
            <img style="width:200px; height:auto;" src="{{ asset('/') }}/img/cargosMunicipales/{{$cargo->fotografia}}">
        </div>
        <div style="padding-top: 10px">
            <h3 style="text-align: center">{{ ($cargo->nombre==null) ? 'Sin nombre' : $cargo->nombre }}</h3>
            <table class="table-hover" style="width: 100%;">
                <tbody>
                    <tr style="background-color:#ddd">
                        <th>Dirección General</th>
                        <td>{{ $cargo->direccion_gral }}</td>
                    </tr>
                    <tr>
                        <th>Cargo</th>
                        <td>{{ $cargo->cargo }}</td>
                    </tr>
                    <tr style="background-color:#ddd">
                        <th>Género</th>
                        <td>{{ ($cargo->genero==null) ? 'Sin especificar' : (($cargo->genero=='M') ? 'Mujer' : 'Hombre') }}</td>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td>{{ ($cargo->telefono==null) ? 'Sin teléfono' : $cargo->telefono }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <br><a href="javascript:;" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fa fa-times mr-2"></i>Cerrar</a>
            <button class="btn btn-success" onclick="editCargo({{$cargo->id}})"><i class="fa fa-edit mr-2"></i>Editar</button>
        </div>
    </div>
</div>
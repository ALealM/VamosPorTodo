<table class="table tile table-hover thead-dark dataTable" role='grid' id="data-table">
    <thead>
        <tr>
            <th>Actividad</th>
            <th>Avance</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>actividad principal - acordada en reunión</td>
            <td>78<br>
                <Chart sparkline>
                    <Line data={data} options={options} />
                </Chart>
            </td>
            <td>2021/10/21</td>
                        <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                             Acciones
                                            </button>
                                                                     <div class="dropdown-menu">

                                                    <a href="{{url('/peticion/avance_evidenciaEdit/1')}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
                                            <a href="{{url('/peticion/avance_evidenciaDelete/1')}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Eliminar </a><br>

                                        </div>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                    <td>segunda actividad a realizar</td>
                                    <td>56</td>
                                    <td>2021/10/21</td>
                                    <td class="text-center">
                                        <div class="btn-group m-0" role="group">
                                            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu">

                                                <a href="{{url('/peticion/avance_evidenciaEdit/2')}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-pencil mr-2"></i>Editar </a><br>
                                                <a href="{{url('/peticion/avance_evidenciaDelete/2')}}" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-trash-o mr-2"></i>Eliminar </a><br>

                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                </tbody>
                                </table>

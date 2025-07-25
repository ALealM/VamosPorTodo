<?php $__env->startSection('title', 'Main page'); ?>
<?php $__env->startSection('content'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<style>
    .form-control {
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .btn_evt {
        padding-top: 1px;
        padding-bottom: 1px;
        height: 27px;
        text-align:center;
    }
</style>
<form method="post" id="form_ExcelNomina" action="<?php echo e(URL::to('excelNomina')); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <div class="row col-md-12 center" style="text-align: center">
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Año</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-10 mr-auto ml-auto" style="margin-bottom: 0px; margin-top: 0px">
                                <?php echo Form::select('anio',['2022'=>'2022'],'2022',['class'=>'form-control select2','placeholder'=>'Seleccione el año...']); ?><i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Quincena</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                <?php echo Form::select('quincena',$quincenas,null,['class'=>'form-control select2','id'=>'quincena']); ?><i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Dirección</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                <?php echo Form::select('direccion',$direcciones,null,['class'=>'form-control select2','id'=>'direccion','placeholder'=>'Seleccione la dirección...','onchange'=>'getDeptos()']); ?><i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Departamento</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                <?php echo Form::select('depto',$departamentos,null,['class'=>'form-control select2','id'=>'depto','placeholder'=>'Seleccione el departamento...']); ?><i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Puesto</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                <?php echo Form::select('puesto',$puestos,null,['class'=>'form-control select2','placeholder'=>'Seleccione el puesto...','id'=>'puesto']); ?><i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Fecha Inicial <small>(Ingreso)</small></h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                <?php echo Form::date('fecha_i',null,['class'=>'form-control','id'=>'fecha_i']); ?><i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Fecha Final <small>(Ingreso)</small></h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                <?php echo Form::date('fecha_f',null,['class'=>'form-control','id'=>'fecha_f']); ?><i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Orden</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                <?php echo e(Form::select('orden',$orden,null,['class'=>'form-control select2','id'=>'orden'])); ?><i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px">
                                <h4 style="margin-bottom: 0px">Pensionados <small>(Pensionados/Viudas/Orfandad)</small></h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px">
                                <?php echo e(Form::select('pensionados',['1'=>'Sin pensionados','2'=>'Con pensionados'],2,['class'=>'form-control select2','id'=>'pensionados'])); ?><i class="form-group__bar"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px"><br>
                                <h4 style="margin-bottom: 0px"><b>Sueldo Mensual</b></h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px; text-align: center" id='mensual'>
                                <h4><b>$ 0.00</b></h4>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px"><br>
                                <h4 style="margin-bottom: 0px"><b>Neto a Pagar</b></h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px; text-align: center" id='neto'>
                                <h4><b>$ 0.00</b></h4>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="dataTable table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <th>
                            <div class="col-md-12 text-center"><hr style="margin-bottom: 5px; margin-top: 5px"><br>
                                <h4 style="margin-bottom: 0px"><b>Altas/Bajas</b></h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group col-md-12" style="margin-bottom: 0px; margin-top: 0px; text-align: center" id='ab'>
                                <h4><b>0/0</b></h4>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <br>
            <button type="button" class="btn btn-info btn-sm" onclick="buscar()"><i class="fa fa-search mr-2"></i>Consultar</button>
            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o mr-2"></i>Generar</button>
        </div>
        <hr>
    </div>
</form>
<div id='contenido' style="text-align: center"></div>
<script>

    $(document).ready(function () {
        $('.select2').select2();
        Highcharts.setOptions({
            colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                    },
                    stops: [
                        [0, color],
                        [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
            })
        });
    });

    function buscar() {
        var q = $('#quincena').val();
        var dir = $('#direccion').val();
        var dep = $('#depto').val();
        var p = $('#puesto').val();
        var fi = $('#fecha_i').val();
        var ff = $('#fecha_f').val();
        var ord = $('#orden').val();
        var pen = $('#pensionados').val();
        $('#grafica').empty();
        $('#contenido').empty();
        $('#contenido').append('<hr><img src="../img/preloader4.gif" style="width:40%"/>');
        $.get(BASE_URL + "buscarNomina", {'q': q, 'dir': dir, 'dep': dep, 'p': p, 'fi': fi, 'ff': ff, ord: ord, 'pen': pen}, function (r) {
            $('#contenido').empty();
            $('#contenido').append(r);
        });
    }

    function getDeptos() {
        var dir = $('#direccion').val();
        $("#depto > option").remove();
        $('#depto').append('<option value="">Seleccione el departamento...</option>');
        $.get(BASE_URL + "getDeptos", {'dir': dir}, function (result) {
            $(result).each(function (i, v) { // indice, valor
                $('#depto').append('<option value="' + v.id + '">' + v.cve_depto + ' - ' + v.departamento + '</option>');
            });
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app',['activePage' => 'consulta', 'mainPage' => 'nomina'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
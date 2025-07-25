<table class="table tile table-hover dataTable" role='grid' id="data-table" style="width: 100%">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Fecha</th>
            <th>Título</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php  $i=1  ?>
        <?php $__currentLoopData = $informes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo date( 'd/m/Y', strtotime($informe->fecha_informe) ); ?></td>
            <td>Informe del día <?php echo date( 'd/m/Y', strtotime($informe->fecha_informe) ); ?></td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        <a href="<?php echo e(url('/panel/showID/'.$informe->fecha_informe)); ?>" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha</a><br>
                        <a class="col-12 btn btn-secondary btn-sm" onclick="informePDF('<?php echo $informe->fecha_informe; ?>')" ><i class="fa fa-download"></i>&nbsp;Descargar</a><br>
                    </div>
                </div>
            </td>
        </tr>
        <?php  $i++  ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
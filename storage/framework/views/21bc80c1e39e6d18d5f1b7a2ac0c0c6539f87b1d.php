<table class="table tile table-hover dataTable" role='grid' id="data-table" style="width: 100%">
    <thead>
        <tr>
            <th style=" width: 30px">#</th>
            <th>Fecha</th>
            <th>Título</th>
            <th>Estatus</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!--0 eliminados
        1 oficilia
        2 inventario-->
        <?php  $i=1  ?>
        <?php $__currentLoopData = $informes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $informe->fecha; ?></td>
            <td>Informe del día <?php echo date( 'd/m/Y', strtotime($informe->fecha) ); ?></td>
            <td id='tdInf<?php echo e($informe->id); ?>'><?php echo $informe->estatus(); ?></td>
            <td class="text-center">
                <div class="btn-group m-0" role="group">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu">
                        <?php if($informe->estatus==0 || $informe->estatus==3): ?>
                        <?php if($informe->informe!=null && $informe->estatus==0): ?>
                        <a class="col-12 btn btn-info btn-sm" style="color: white" onclick="informeEnviar(<?php echo $informe->id; ?>)" id='btnEnv<?php echo e($informe->id); ?>' ><i class="fa fa-arrow-circle-o-right"></i> Enviar</a><br>
                        <?php endif; ?>                        
                        <a href="<?php echo e(url('/informe/edit/'.$informe->id)); ?>" class="col-12 btn btn-secondary btn-sm" id='btnEd<?php echo e($informe->id); ?>'><i class="fa fa-pencil-square-o mr-2"></i>Editar</a>
                        <?php endif; ?>                        
                        <a href="<?php echo e(url('/informe/show/'.$informe->id)); ?>" class="col-12 btn btn-secondary btn-sm"><i class="fa fa-eye mr-2"></i>Ficha</a><br>                        
                    </div>
                </div>
            </td>
        </tr>
        <?php  $i++  ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
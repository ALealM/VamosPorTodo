<div class="col-md-12 text-center row">
    <div class="col-md-12">
        <hr>
        <span style="font-size: 20px">Diagnóstico municipal</span> <span style="font-weight: 400; font-size: 20px"><?php echo e($colonia->colonia); ?></span>
        <br><a onclick="informeCol(<?php echo e($colonia->id); ?>)" style="color: green; cursor: pointer;" class="btn btn-sm btn-outline-success"><i class="fa fa-download"></i></a>
        <br><br>
    </div>
    <?php $__currentLoopData = $rubros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rubro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-4 card" style="margin-top: 15px; margin-bottom: 15px">
        <div class="footer-widget">
            <div class="col-md-12" style=" background-color: <?php echo e(($rubro->asuntos->isEmpty()) ? '#ff9999' : '#b4d790'); ?>">
                <h5><?php echo (!$rubro->asuntos->isEmpty()) ? '<a onclick="informeColRub('.$colonia->id.','.$rubro->id.')" style="color: green; cursor: pointer;"><i class="fa fa-download"></i></a>' : ''; ?>&nbsp;&nbsp;<b><?php echo e($rubro->nombre); ?></b></h5>
            </div>
            <table class="table-borderless table-condensed" style="width: 100%">
                <tbody>
                    <tr>
                        <td>
                            <div style="margin-top: 5px; margin-bottom: 15px">
                                <div class="col-md-12">
                                    <ul>
                                        <?php if($rubro->asuntos->isEmpty()): ?>
                                        <li>Sin Asuntos Registrados</li>
                                        <?php else: ?>
                                        <?php $__currentLoopData = $rubro->asuntos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($asunto->asunto); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>                                                                                
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
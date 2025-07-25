<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <p style="font-size: 18px">Bienvenido</p>
                    <h3><?php echo e(\Auth::User()->nombre); ?> <?php echo e(\Auth::User()->ap_paterno); ?> <?php echo e(\Auth::User()->ap_materno); ?></h3>
                </div>
                <?php if(\Auth::User()->tipo == 12): ?>
                <div class="panel-body text-center">
                    <h1>SISTEMA DE LÍNEAS DE ACCIÓN</h1>
                </div>
                <?php else: ?>
                <div class="panel-body text-center">
                    <img src="../img/cuadros.png" style="max-width:15%;width:auto;height:auto;padding-top: 30px"/>
                </div>
                <div class="panel-body text-center">                    
                    <h1>SISTEMA DE INFORMACIÓN</h1>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'inicio'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
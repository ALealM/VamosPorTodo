<?php $__env->startSection('title', 'Main page'); ?>
<?php $__env->startSection('content'); ?>

<div class="mb-2 mt-2">
    <a href="<?php echo e(url('informe/create')); ?>" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo informe diario</a>    
</div>

<?php if($informes->isEmpty()): ?>
<div class="text-center">No hay informes dados de alta para mostrar</div>
<?php else: ?>
<?php echo $__env->make('informes.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<script>
    function informePDF(id) {
        window.location = BASE_URL + "informePDF/" + id;
    }

    function informeEnviar(id) {
        $.get(BASE_URL + "informeEnviar", {'id': id}, function (r) {
            $('#tdInf' + id).empty();
            $('#tdInf' + id).append('Enviado');
            $('#btnEnv' + id).removeAttr('onclick');
            $('#btnEnv' + id).removeAttr('style');
            $('#btnEnv' + id).attr('style', 'display:none');
            $('#btnEd' + id).removeAttr('onclick');
            $('#btnEd' + id).removeAttr('style');
            $('#btnEd' + id).attr('style', 'display:none');
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['activePage' => 'informe', 'mainPage' => 'informe'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
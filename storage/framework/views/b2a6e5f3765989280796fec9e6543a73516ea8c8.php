<div class="wrapper ">
  <?php echo $__env->make('layouts.navbars.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <div class="main-panel">
    <?php echo $__env->make('layouts.navbars.navs.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="content pt-0">
      <div class="container-fluid">
        <div class="card">
          <div class="bg-fbm-blue card-header">
            <h4 class="card-title text-white"><?php echo mb_strtoupper(@$sTitulo); ?></h4>
            <p class="card-category"><?php echo @$sDescripcion; ?></p>
          </div>
          <div class="card-body <?php echo e(@$sClassCardBody); ?>">

            <?php echo $__env->yieldContent('content'); ?>

          </div>
        </div>
      </div>
    </div>

    <?php echo $__env->make('layouts.footers.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>

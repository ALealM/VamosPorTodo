<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand"><?php echo e(@$titlePage); ?> <small><?php echo e(@$descriptionPage); ?></small></a>
    </div>

    <div class="">
      <small>
        <?php if( @$aBreadCrumb != null ): ?>
        <a href="<?php echo e(url('home')); ?>" class="color-fbm-blue">Inicio</a>
        <?php $__currentLoopData = $aBreadCrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aBread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if( $aBread['link'] == 'active' ): ?>
        / <a> <?php echo e($aBread['label']); ?> </a>
        <?php else: ?>
        / <a href="<?php echo e($aBread['link']); ?>" class="color-fbm-blue"> <?php echo e($aBread['label']); ?> </a>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </small>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
      </ul>
    </div>
  </div>
</nav>

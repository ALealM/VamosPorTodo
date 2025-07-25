<?php $__env->startSection('content'); ?>
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo e(csrf_field()); ?>


        <div class="card card-login card-hidden mb-3">

          <div class="card-header text-center">
            <div class="logo">
              <img style="width:100px" src="<?php echo e(asset('/')); ?>/img/cuadros.png">
            </div>
          </div>
<!--          div class="card-header pt-0 pb-0 text-right">
            <div class="logo">
              <img style="width:25px" src="<?php echo e(asset('material')); ?>/img/FBM_LOGO_GRIS.png">
            </div>
          </div-->
          <div class="card-body">
            <p class="card-description text-center"><?php echo e(__('Ingrese su')); ?> <strong>correo electrónico</strong> <?php echo e(__(' y su ')); ?><strong>contraseña</strong> </p>

            <div class="bmd-form-group<?php echo e($errors->has('correo') ? ' has-danger' : ''); ?>">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="correo" class="form-control" placeholder="<?php echo e(__('Correo electrónico...')); ?>" value="<?php echo e(old('email')); ?>" required>
              </div>
              <?php if($errors->has('correo')): ?>
              <div id="correo-error" class="error text-danger pl-3" for="correo" style="display: block;">
                <strong><?php echo e($errors->first('correo')); ?></strong>
              </div>
              <?php endif; ?>
            </div>
            <div class="bmd-form-group<?php echo e($errors->has('password') ? ' has-danger' : ''); ?> mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo e(__('Contraseña...')); ?>" required>
              </div>
              <?php if($errors->has('password')): ?>
              <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                <strong><?php echo e($errors->first('password')); ?></strong>
              </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-link btn-lg color-fbm-blue"><?php echo e(__('Iniciar sesión')); ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Sistema de Información')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
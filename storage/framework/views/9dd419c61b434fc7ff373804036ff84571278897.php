
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

      <!--form class="navbar-form">
        <div class="input-group no-border">
          <input type="text" value="" class="form-control" placeholder="Search...">
          <button type="submit" class="btn btn-white btn-round btn-just-icon">
            <i class="material-icons">search</i>
            <div class="ripple-container"></div>
          </button>
        </div>
      </form-->
      <?php if(session('login_consultor') == true): ?>
        <div class="mr-2 color-fbm-blue">
          <i class="fa fa-eye mr-1"></i><small>Sesión de consultor (asesoría).</small>
        </div>
      <?php endif; ?>




      <small><?php echo e(\Auth::User()->nombre); ?> <?php echo e(\Auth::User()->ap_paterno); ?> <?php echo e(\Auth::User()->ap_materno); ?></small>

      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#perfil" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <small>| <?php echo e(@\Auth::User()->email); ?></small>
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block"></p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <div class="text-center">
              <!--<img src="<?php echo e(asset("material/img/logo.png")); ?>" alt="usuario" style="height: 50px; width: auto"/>-->
            </div>
            <!--<a class="btn btn-secondary text-left col-12" href="<?php echo e(url('usuarios/editar/' . @\Auth::User()->id )); ?>">Mi perfil</a>-->
            <a class="btn btn-secondary text-left col-12" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar Sesión</a>
          </div>
        </li>
      </ul>

    </div>
  </div>
</nav>

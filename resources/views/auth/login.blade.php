@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Sistema de Información')])
@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="card card-login card-hidden mb-3">

          <div class="card-header text-center">
            <div class="logo">
              <img style="width:100px" src="{{ asset('/') }}/img/cuadros.png">
            </div>
          </div>
<!--          div class="card-header pt-0 pb-0 text-right">
            <div class="logo">
              <img style="width:25px" src="{{ asset('material') }}/img/FBM_LOGO_GRIS.png">
            </div>
          </div-->
          <div class="card-body">
            <p class="card-description text-center">{{ __('Ingrese su') }} <strong>correo electrónico</strong> {{ __(' y su ') }}<strong>contraseña</strong> </p>

            <div class="bmd-form-group{{ $errors->has('correo') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="correo" class="form-control" placeholder="{{ __('Correo electrónico...') }}" value="{{ old('email') }}" required>
              </div>
              @if ($errors->has('correo'))
              <div id="correo-error" class="error text-danger pl-3" for="correo" style="display: block;">
                <strong>{{ $errors->first('correo') }}</strong>
              </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Contraseña...') }}" required>
              </div>
              @if ($errors->has('password'))
              <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                <strong>{{ $errors->first('password') }}</strong>
              </div>
              @endif
            </div>
          </div>

          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-link btn-lg color-fbm-blue">{{ __('Iniciar sesión') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

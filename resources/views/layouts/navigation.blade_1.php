<?php

$colors = ['bg-primary','bg-success','bg-info','bg-warning','bg-danger'];

?>
<aside class="sidebar">
  <div class="scrollbar-inner">

    <div class="user">
      <div class="user__info" data-toggle="dropdown">
        <img class="user__img" src="{{ asset((\Auth::User()->fotografia!=null) ? 'img/usuarios/'.\Auth::User()->fotografia : "img/usuarios/default.png") }}" alt="">
        <div>
          <div class="user__name">{{ \Auth::User()->nombre . ' ' . \Auth::User()->ap_paterno . ' ' . \Auth::User()->ap_materno }}</div>
          <div class="user__email">{{ \Auth::User()->correo }}</div>
        </div>
      </div>

      <div class="dropdown-menu" style="background-color: #DCD8D8">
        <!--<a class="dropdown-item" href="">View Profile</a>-->
        <!--<a class="dropdown-item" href="">Settings</a>-->
        <a href="{{ url('usuarios/cambiar_contrasena') }}/{{\Auth::User()->id}}" class="dropdown-item" style="color: #656565"><i class="fa fa-key mr-2"></i>Cambiar contraseña</a>
        <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #656565"><i class="fa fa-sign-out mr-2"></i>Cerrar sesión</a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
      </div>
    </div>
    <ul class="navigation">
      <li class="{{ (Request::is('home') ? 'navigation__active' : '') }}">
        <a href="{{url('/home')}}"><i class="fa fa-home mr-2"></i>Inicio</a>
      </li>
      @php
      /*
      0 - SuperUsuario
      '3' => 'Oficialía de partes',
      '1' => 'Dirección general',
      '5' => 'Seguimiento',
      '2' => 'Inventario',
      '6' => 'Ordenes',
      '4' => 'Trabajador con área asignada'
      */
      $aPermisos = [
        'usuarios' => [ 0 ],
        'archivo' => [ 0, 3 ],
        'archivoAsig' => [ 0, 1 ],
        'seguimiento' => [ 0, 5 ],
        'respuesta' => [ 0, 4 ],
        'inventario' => [ 0, 1, 2, 3, 4, 5 ],
        'ordenes' => [ 0, 6 ],
        'calendario' => [ 0, 1, 2, 3, 4, 5 ],
        'bitacora' => [ 0, 5 ]
      ];
      @endphp

      @if( in_array( \Auth::User()->tipo, $aPermisos['usuarios'] )  )
        <li class="{{ (Request::is('usuarios/*') ? 'navigation__active' : '') }}">
          <a href="{{url('/usuarios/index')}}"><i class="fa fa-users mr-2"></i>Usuarios</a>
        </li>
      @endif

      @if( in_array( \Auth::User()->tipo, $aPermisos['archivo'] )  || (\Auth::User()->tipo==4 && \Auth::User()->area==3 && \Auth::User()->director == 1) ) <!--Oficialia de partes y juridico-->
        <li class="{{ (Request::is('archivo/*') ? 'navigation__active' : '') }}">
          <a href="{{url('/archivo/index')}}"><i class="fa fa-archive mr-2"></i>Asuntos</a>
        </li>
      @endif

      @if( in_array( \Auth::User()->tipo, $aPermisos['archivoAsig'] )  )
        <li class="{{ (Request::is('archivoAsig/*') ? 'navigation__active' : '') }}">
          <a href="{{url('/archivoAsig/index')}}"><i class="fa fa-briefcase mr-2"></i>Dirección General</a>
        </li>
      @endif

      @if( in_array( \Auth::User()->tipo, $aPermisos['seguimiento'] ) || (\Auth::User()->tipo == 4 && \Auth::User()->director == 1) )<!--Directores de área-->
        <li class="{{ (Request::is('seguimiento/*') ? 'navigation__active' : '') }}">
          <a href="{{url('/seguimiento/index')}}"><i class="fa fa-sitemap mr-2"></i>Asignación</a>
        </li>
      @endif

      @if( in_array( \Auth::User()->tipo, $aPermisos['respuesta'] )  )
        <li class="{{ (Request::is('respuesta/*') ? 'navigation__active' : '') }}">
          <a href="{{url('/respuesta/index')}}"><i class="fa fa-thumbs-up mr-2"></i>Respuesta</a>
        </li>
      @endif

      @if( in_array( \Auth::User()->tipo, $aPermisos['inventario'] )  )
        <li class="{{ (Request::is('inventario/*') ? 'navigation__active' : '') }}">
          <a href="{{url('/inventario/index')}}"><i class="fa fa-book mr-2"></i>Inventario</a>
        </li>
      @endif

      @if( in_array( \Auth::User()->tipo, $aPermisos['calendario'] )  )
        <li class="{{ (Request::is('calendario/*') ? 'navigation__active' : '') }}">
          <a href="{{url('/calendario/index')}}"><i class="fa fa-calendar"></i>Calendario</a>
        </li>
      @endif

      @if( in_array( \Auth::User()->tipo, $aPermisos['bitacora'] )  )
        <li class="{{ (Request::is('bitacora/*') ? 'navigation__active' : '') }}">
          <a href="{{url('/bitacora/index')}}"><i class="fa fa-list-alt mr-2"></i>Bitácora</a>
        </li>
      @endif

      <li>
        <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out mr-2"></i>Cerrar sesión</a>
      </li>

      <li class="navigation__active">
      </ul>
    </div>
  </aside>

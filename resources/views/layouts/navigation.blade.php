<?php
$colors = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger'];
?>
<aside class="sidebar">
    <div class="scrollbar-inner">

        <div class="user">
            <div class="user__info" data-toggle="dropdown">
                <img class="user__img" src="{{ asset((@\Auth::User()->fotografia!=null) ? 'img/usuarios/'.\Auth::User()->fotografia : "img/usuarios/default.png") }}" alt="">
                     <div>
                    <div class="user__name">{{ @\Auth::User()->nombre . ' ' . @\Auth::User()->ap_paterno . ' ' . @\Auth::User()->ap_materno }}</div>
                    <div class="user__email">{{ @\Auth::User()->correo }}</div>
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
            <li class="{{ (Request::is('home') || Request::is('/') || Request::is('admin')) ? 'navigation__active' : '' }}">
                <a href="{{url('/')}}"><i class="fa fa-home mr-2"></i>Inicio</a>
            </li>
            <li class="{{ (Request::is('dashboard') ? 'navigation__active' : '') }}">
                <a href="{{url('/dashboard')}}"><i class="fa fa-th mr-2"></i>Dashboard</a>
            </li>
            <li class="{{ (Request::is('acciones/*') || Request::is('accion/*')) ? 'navigation__active' : '' }}">
                <a href="{{url('/acciones/listado')}}"><i class="fa fa-list-alt mr-2"></i>Acciones</a>
            </li>
            <li class="navigation__sub {{ (Request::is('catalogos/*') ? 'navigation__sub--active navigation__sub--toggled' : '') }}">
                <a href=""><i class="fa fa-list-ol"></i> Catálogos</a>
                <ul>
                    <li class="{{ (Request::is('catalogos/tipoAcciones') ? 'navigation__active' : '') }}">
                        <a href="{{url('catalogos/tipoAcciones')}}">Tipos Acciones</a>
                    </li>
                    <li class="{{ (Request::is('catalogos/tipoBeneficiarios') ? 'navigation__active' : '') }}">
                        <a href="{{url('catalogos/tipoBeneficiarios')}}">Tipos Beneficiarios</a>
                    </li>
                    <li class="{{ (Request::is('catalogos/colonias') ? 'navigation__active' : '') }}">
                        <a href="{{url('catalogos/colonias')}}">Colonias</a>
                    </li>
                    <li class="{{ (Request::is('catalogos/secretarias') ? 'navigation__active' : '') }}">
                        <a href="{{url('catalogos/secretarias')}}">Secretarías</a>
                    </li>
                    <li class="{{ (Request::is('catalogos/responsables') ? 'navigation__active' : '') }}">
                        <a href="{{url('catalogos/responsables')}}">Responsables</a>
                    </li>
                </ul>
            </li>
            <li class="navigation__active">
        </ul>
    </div>
</aside>

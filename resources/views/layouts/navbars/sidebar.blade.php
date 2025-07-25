<div class="sidebar" data-color="" data-background-color="white" >
    <div class="logo text-center">
        <a href="/" class="simple-text logo-mini">
            INFO
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
                <li class="nav-item {{ @$activePage == 'inicio' ? ' active' : '' }}" style="{{ @$activePage == 'inicio' ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/')}}">
                        <i class="material-icons" style="{{ @$activePage == 'inicio' ? 'color: #fff' : '' }}">home</i>
                        <p>Inicio</p>
                    </a>
                </li>
                @if(\Auth::User()->tipo == 12)
                <li class="nav-item {{ (@$activePage == 'panel') ? ' active' : '' }}" style="{{ (@$activePage == 'panel' ) ? ' background-color: #083655; color: #fff' : '' }}">
                <a class="nav-link" href="{{url('/panelAc')}}">
                    <i class="material-icons" style="{{ (@$activePage == 'panel') ? 'color: #fff' : '' }}">view_day</i>
                    <p>Panel</p>
                </a>
            </li>
            <li class="nav-item {{ (@$activePage == 'acciones') ? ' active' : '' }}" style="{{ (@$activePage == 'acciones') ? ' background-color: #083655; color: #fff' : '' }}">
                <a class="nav-link" href="{{url('/lineasAccion')}}">
                    <i class="material-icons" style="{{ (@$activePage == 'acciones') ? 'color: #fff' : '' }}">backup_table</i>
                    <p>Acciones</p>
                </a>
            </li>
            <li class="nav-item {{ @$mainPage == 'unidades' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#unidades" aria-expanded="{{ @$mainPage == 'unidades' ? ' true' : '' }}"  style="{{ @$mainPage == 'unidades' ? ' background-color: #083655; color: #fff' : '' }}">
                    <i class="material-icons">file_copy</i>
                    <p>{{ __('Catálogos') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ @$mainPage == 'unidades' ? ' show' : '' }}" id="unidades">
                    <ul class="nav" style="margin-top:0px; background-color: #eee">
                        <li class="nav-item{{ (@$activePage == 'unidades') ? ' active' : '' }}" style="{{ (@$activePage == 'unidades') ? ' background-color: #28628a' : '' }}">
                            <a class="nav-link" href="{{url('/catalogos/unidades')}}">
                                <i class="material-icons">file_copy</i>
                                <p>{{ __('Unidades') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @else
            @if(\Auth::User()->tipo == 0 ||  \Auth::User()->tipo == 4)
                <li class="nav-item {{ (@$activePage == 'acciones') ? ' active' : '' }}" style="{{ (@$activePage == 'acciones') ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/acciones')}}">
                        <i class="material-icons" style="{{ (@$activePage == 'acciones') ? 'color: #fff' : '' }}">task_alt</i>
                        <p>Acciones Municipales</p>
                    </a>
                </li>
            @endif
            @if( \Auth::User()->tipo == 0 ||  \Auth::User()->tipo == 11 ||  \Auth::User()->tipo == 4 )
                <li class="nav-item {{ @$mainPage == 'nomina' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#nomina" aria-expanded="{{ @$mainPage == 'nomina' ? ' true' : '' }}"  style="{{ @$mainPage == 'nomina' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">paid</i>
                        <p>{{ __('Nómina') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'nomina' ? ' show' : '' }}" id="nomina">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            @if( \Auth::User()->tipo != 4 )
                            <li class="nav-item{{ (@$activePage == 'carga') ? ' active' : '' }}" style="{{ (@$activePage == 'carga') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/cargaNomina')}}">
                                    <i class="material-icons"> backup </i>
                                    <p>{{ __('Carga') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ (@$activePage == 'cambioss') ? ' active' : '' }}" style="{{ (@$activePage == 'cambioss') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/nominaAB')}}">
                                    <i class="material-icons"> call_split </i>
                                    <p>{{ __('Cambios/Altas/Bajas') }}</p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item{{ (@$activePage == 'consulta') ? ' active' : '' }}" style="{{ (@$activePage == 'consulta') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/nomina')}}">
                                    <i class="material-icons"> list </i>
                                    <p>{{ __('Consulta') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if(\Auth::User()->tipo == 0)
                <li class="nav-item {{ (@$activePage == 'juntas') ? ' active' : '' }}" style="{{ (@$activePage == 'juntas') ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/juntas')}}">
                        <i class="material-icons" style="{{ (@$activePage == 'juntas') ? 'color: #fff' : '' }}">groups</i>
                        <p>Juntas Participación Ciudadana</p>
                    </a>
                </li>
            @endif
            @if(\Auth::User()->tipo == 10 || \Auth::User()->tipo == 0 || \Auth::User()->id == 74)
                <li class="nav-item {{ @$mainPage == 'programas' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#programas" aria-expanded="{{ @$mainPage == 'programas' ? ' true' : '' }}"  style="{{ @$mainPage == 'programas' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">supervised_user_circle</i>
                        <p>{{ __('Programas Sociales') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'programas' ? ' show' : '' }}" id="programas">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'solicitudes') ? ' active' : '' }}" style="{{ (@$activePage == 'solicitudes') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/solicitudes')}}">
                                    <i class="material-icons"> list_alt </i>
                                    <p>{{ __('Solicitudes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ (@$activePage == 'padron') ? ' active' : '' }}" style="{{ (@$activePage == 'padron') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/padronBeneficiarios')}}">
                                    <i class="material-icons"> accessibility </i>
                                    <p>{{ __('Padrón de Beneficiarios') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ (@$activePage == 'colonias') ? ' active' : '' }}" style="{{ (@$activePage == 'colonias') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/colonias')}}">
                                    <i class="material-icons"> assignment </i>
                                    <p>{{ __('Colonias') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ (@$activePage == 'rubros') ? ' active' : '' }}" style="{{ (@$activePage == 'rubros') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/rubros')}}">
                                    <i class="material-icons"> assignment </i>
                                    <p>{{ __('Rubros') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ (@$activePage == 'programas') ? ' active' : '' }}" style="{{ (@$activePage == 'programas') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/programas')}}">
                                    <i class="material-icons"> assignment </i>
                                    <p>{{ __('Programas') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            
            @if(\Auth::User()->tipo == 1)
                <li class="nav-item {{ (@$activePage == 'Indicadores') ? ' active' : '' }}" style="{{ (@$activePage == 'Indicadores') ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/indicadores')}}">
                        <i class="material-icons" style="{{ (@$activePage == 'Indicadores') ? 'color: #fff' : '' }}">trending_up</i>
                        <p>Indicadores</p>
                    </a>
                </li>
            @endif
           
            @if(\Auth::User()->id == 2)
                <li class="nav-item {{ (@$activePage == 'contratos') ? ' active' : '' }}" style="{{ (@$activePage == 'contratos') ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/contratos')}}">
                        <i class="material-icons" style="{{ (@$activePage == 'contratos') ? 'color: #fff' : '' }}">work</i>
                        <p>Contratos</p>
                    </a>
                </li>
                <li class="nav-item {{ (@$activePage == 'convenios') ? ' active' : '' }}" style="{{ (@$activePage == 'convenios') ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/convenios')}}">
                        <i class="material-icons" style="{{ (@$activePage == 'convenios') ? 'color: #fff' : '' }}">handshake</i>
                        <p>Convenios</p>
                    </a>
                </li>
                <li class="nav-item {{ @$activePage == 'servMunic' ? ' active' : '' }}" style="{{ @$activePage == 'servMunic' ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/indexServiciosMunicipales')}}">
                        <i class="material-icons" style="{{ @$activePage == 'servMunic' ? 'color: #fff' : '' }}">business</i>
                        <p>Servicios Municipales</p>
                    </a>
                </li>
            
                <li class="nav-item {{ @$activePage == 'ecologia' ? ' active' : '' }}" style="{{ @$activePage == 'ecologia' ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/indexEcologia')}}">
                        <i class="material-icons" style="{{ @$activePage == 'ecologia' ? 'color: #fff' : '' }}">wb_sunny </i>
                        <p>Ecología</p>
                    </a>
                </li>
            @endif
            
            
           
            @if( in_array( \Auth::User()->id, [2] ) )
            <!-- 6,67 -->
            
                <li class="nav-item {{ @$activePage == 'portada' ? ' active' : '' }}" style="{{ @$activePage == 'portada' ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/portadaAreasAtencion')}}">
                        <i class="material-icons" style="{{ @$activePage == 'portada' ? 'color: #fff' : '' }}"> face-agent </i>
                        <p> Áreas de Atención </p>
                    </a>
                </li>
            @endif
           
           
           
           
             
             
             
            @if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 4)
                <li class="nav-item {{ (@$activePage == 'panel' || @$activePage == 'showID' || @$activePage == 'showEV' || @$activePage == 'showPOA') ? ' active' : '' }}" style="{{ (@$activePage == 'panel' || @$activePage == 'showID' || @$activePage == 'showEV' || @$activePage == 'showPOA') ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/panel')}}">
                        <i class="material-icons" style="{{ (@$activePage == 'panel' || @$activePage == 'showID' || @$activePage == 'showEV' || @$activePage == 'showPOA') ? 'color: #fff' : '' }}">view_day</i>
                        <p>Panel</p>
                    </a>
                </li>
            @endif
            
            @if(\Auth::User()->tipo < 3)
                <li class="nav-item {{ (@$activePage == 'proyectoAccion' || @$activePage == 'createProyectoAccion' || @$activePage == 'showProyectoAccion' || @$activePage == 'editProyectoAccion') ? ' active' : '' }}" style="{{ (@$activePage == 'proyectoAccion' || @$activePage == 'createProyectoAccion' || @$activePage == 'showProyectoAccion' || @$activePage == 'editProyectoAccion') ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/proyectoAccion/listado')}}">
                        <i class="material-icons" style="{{ (@$activePage == 'proyectoAccion' || @$activePage == 'createProyectoAccion' || @$activePage == 'showProyectoAccion' || @$activePage == 'editProyectoAccion') ? 'color: #fff' : '' }}">backup_table</i>
                        <p>Proyectos y Acciones</p>
                    </a>
                </li>
            @endif
            
            @if(\Auth::User()->tipo == 0)
                <li class="nav-item {{ @$mainPage == 'agenda' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#agenda" aria-expanded="{{ @$mainPage == 'agenda' ? ' true' : '' }}"  style="{{ @$mainPage == 'agenda' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">fact_check</i>
                        <p>{{ __('AGENDA ESTRATÉGICA') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'agenda' ? ' show' : '' }}" id="agenda">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'agendaCreate') ? ' active' : '' }}" style="{{ (@$activePage == 'agendaCreate') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/agenda/create')}}">
                                    <i class="material-icons"> class </i>
                                    <p>{{ __('Nueva') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ (@$activePage == 'agenda') ? ' active' : '' }}" style="{{ (@$activePage == 'agenda') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/agenda/listado')}}">
                                    <i class="material-icons"> assignment </i>
                                    <p>{{ __('Todas') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if( \Auth::User()->tipo == 11)
                <li class="nav-item {{ @$mainPage == 'informe' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#informe" aria-expanded="{{ @$mainPage == 'informe' ? ' true' : '' }}"  style="{{ @$mainPage == 'informe' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">history_edu</i>
                        <p>{{ __('INFORME DIARIO') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'informe' ? ' show' : '' }}" id="informe">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'informe' || @$activePage == 'createInforme' || @$activePage == 'showInforme' || @$activePage == 'editInforme') ? ' active' : '' }}" style="{{ (@$activePage == 'informe' || @$activePage == 'createInforme' || @$activePage == 'showInforme' || @$activePage == 'editInforme') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/informe/listado')}}">
                                    <i class="material-icons">history_edu</i>
                                    <p>{{ __('Informe Diario') }}</p>
                                </a>
                            </li>
                            @if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 3 || \Auth::User()->id ==74  ||  \Auth::User()->tipo == 11 )
                            <li class="nav-item{{ (@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' active' : '' }}" style="{{ (@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/informe/listadoRevision')}}">
                                    <i class="material-icons">file_copy</i>
                                    <p>{{ __('Informes Diarios') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'informeResumen' ? ' active' : '' }}" style="{{ @$activePage == 'informeResumen' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/informe/resumen')}}">
                                    <i class="material-icons">speaker_notes</i>
                                    <p>{{ __('Resumen Informes Diarios') }}</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
        @if(\Auth::User()->tipo < 10)
                <li class="nav-item {{ @$mainPage == 'eventos' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#eventos" aria-expanded="{{ @$mainPage == 'eventos' ? ' true' : '' }}"  style="{{ @$mainPage == 'eventos' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">star_rate</i>
                        <p>{{ __('EVENTOS') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'eventos' ? ' show' : '' }}" id="eventos">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            @if(\Auth::User()->tipo < 3 || \Auth::User()->tipo ==5)
                                <li class="nav-item{{ (@$activePage == 'eventos'|| @$activePage == 'showEvento' || @$activePage == 'editEvento' || @$activePage == 'showObservaciones' || @$activePage == 'createEvento') ? ' active' : '' }}" style="{{ (@$activePage == 'eventos' || @$activePage == 'showEvento' || @$activePage == 'editEvento' || @$activePage == 'showObservaciones' || @$activePage == 'createEvento') ? ' background-color: #28628a' : '' }}">
                                    <a class="nav-link" href="{{url('/eventos/listado')}}">
                                        <i class="material-icons">star_rate</i>
                                        <p>{{ __('Eventos') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item{{ (@$activePage == 'eventosColaboracion' || @$activePage == 'showColaboracionEvento') ? ' active' : '' }}" style="{{ (@$activePage == 'eventosColaboracion' || @$activePage == 'showColaboracionEvento') ? ' background-color: #28628a' : '' }}">
                                    <a class="nav-link" href="{{url('/eventosColaboracion/listado')}}">
                                        <i class="material-icons">people</i>
                                        <p>{{ __('Eventos en Colaboración') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item{{ (@$activePage == 'eventosAutorizados' || @$activePage == 'showAutorizadoEvento' || @$activePage == 'reporteEvento' || @$activePage == 'reporteEventoColaboracion') ? ' active' : '' }}" style="{{ (@$activePage == 'eventosAutorizados' || @$activePage == 'showAutorizadoEvento' || @$activePage == 'reporteEvento' || @$activePage == 'reporteEventoColaboracion') ? ' background-color: #28628a' : '' }}">
                                    <a class="nav-link" href="{{url('/eventos/listadoAutorizado')}}">
                                        <i class="material-icons">how_to_reg</i>
                                        <p>{{ __('Eventos Autorizados') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item{{ (@$activePage == 'eventosDiariosUpdate' ) ? ' active' : '' }}" style="{{ (@$activePage == 'eventosDiariosUpdate') ? ' background-color: #28628a' : '' }}">
                                    <a class="nav-link" href="{{url('/eventosDiariosUpdate')}}">
                                        <i class="material-icons">edit_note</i>
                                        <p>{{ __('a Actualizar') }}</p>
                                    </a>
                                </li>
                            @endif
                                <li class="nav-item{{ (@$activePage == 'calendarioEventosDiarios' ) ? ' active' : '' }}" style="{{ (@$activePage == 'calendarioEventosDiarios') ? ' background-color: #28628a' : '' }}">
                                    <a class="nav-link" href="{{url('/calendarioEventosDiarios')}}">
                                        <i class="material-icons">calendar_month</i>
                                        <p>{{ __('Calendario') }}</p>
                                    </a>
                                </li>
                        </ul>
                    </div>
                </li>
            
            @if(\Auth::User()->tipo < 4 || \Auth::User()->tipo ==5 || \Auth::User()->id ==74  ||  \Auth::User()->tipo == 11)
                <li class="nav-item {{ @$mainPage == 'informe' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#informe" aria-expanded="{{ @$mainPage == 'informe' ? ' true' : '' }}"  style="{{ @$mainPage == 'informe' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">history_edu</i>
                        <p>{{ __('INFORME DIARIO') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'informe' ? ' show' : '' }}" id="informe">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'informe' || @$activePage == 'createInforme' || @$activePage == 'showInforme' || @$activePage == 'editInforme') ? ' active' : '' }}" style="{{ (@$activePage == 'informe' || @$activePage == 'createInforme' || @$activePage == 'showInforme' || @$activePage == 'editInforme') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/informe/listado')}}">
                                    <i class="material-icons">history_edu</i>
                                    <p>{{ __('Informe Diario') }}</p>
                                </a>
                            </li>
                            @if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 3 || \Auth::User()->id ==74  ||  \Auth::User()->tipo == 11 )
                            <li class="nav-item{{ (@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' active' : '' }}" style="{{ (@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/informe/listadoRevision')}}">
                                    <i class="material-icons">file_copy</i>
                                    <p>{{ __('Informes Diarios') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'informeResumen' ? ' active' : '' }}" style="{{ @$activePage == 'informeResumen' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/informe/resumen')}}">
                                    <i class="material-icons">speaker_notes</i>
                                    <p>{{ __('Resumen Informes Diarios') }}</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            
            @if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 1 || \Auth::User()->id == 74)
                <li class="nav-item {{ (@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#acuerdos" aria-expanded="{{ (@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' true' : '' }}"  style="{{ (@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">spellcheck</i>
                        <p>{{ __('ACUERDOS') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' show' : '' }}" id="acuerdos">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/peticion/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Reuniones solicitadas') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ (@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' active' : '' }}" style="{{ (@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/peticion/listado')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Reuniones para autorizar') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'informeResumen' ? ' active' : '' }}" style="{{ @$activePage == 'informeResumen' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/peticion/responsable/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Acuerdos responsables') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'informeResumen' ? ' active' : '' }}" style="{{ @$activePage == 'informeResumen' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/peticion/colaborador/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Acuerdos colaboradores') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            
            @if(\Auth::User()->tipo == 0 )
                <li class="nav-item {{ (@$activePage == 'dashboardInvitados' || @$activePage == 'indexInvitados' || @$activePage == 'mapaInvitados' || @$activePage == 'ordenInvitados' || @$activePage == 'asistentesInvitados') ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#invitados" aria-expanded="{{ (@$activePage == 'indexInvitados' || @$activePage == 'mapaInvitados' || @$activePage == 'ordenInvitados' || @$activePage == 'asistentesInvitados') ? ' true' : '' }}"  style="{{ (@$activePage == 'dashboardInvitados' || @$activePage == 'indexInvitados' || @$activePage == 'mapaInvitados' || @$activePage == 'ordenInvitados' || @$activePage == 'asistentesInvitados') ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">groups</i>
                        <p>{{ __('INVITADOS CONSEJOS') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (@$activePage == 'dashboardInvitados' || @$activePage == 'indexInvitados' || @$activePage == 'mapaInvitados' || @$activePage == 'ordenInvitados' || @$activePage == 'asistentesInvitados') ? ' show' : '' }}" id="invitados">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ @$activePage == 'indexInvitados' ? ' active' : '' }}" style="{{ @$activePage == 'indexInvitados' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/invitados/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'mapaInvitados' ? ' active' : '' }}" style="{{ @$activePage == 'mapaInvitados' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/invitados/mapa')}}">
                                    <i class="material-icons">map_marker_times</i>
                                    <p>{{ __('Mapa') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesInvitados' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesInvitados' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/invitados/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenInvitados' ? ' active' : '' }}" style="{{ @$activePage == 'ordenInvitados' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/invitados/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'dashboardInvitados' ? ' active' : '' }}" style="{{ @$activePage == 'dashboardInvitados' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/invitados/dashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
            
                <li class="nav-item {{ @$activePage == 'indicador' ? ' active' : '' }}" style="{{ @$activePage == 'indicador' ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/indexFichaIndicadores')}}">
                        <i class="material-icons" style="{{ @$activePage == 'indicador' ? 'color: #fff' : '' }}">book</i>
                        <p>Ficha Indicadores de Desempeño</p>
                    </a>
                </li>
            
                <li class="nav-item {{ @$activePage == 'solicitud' ? ' active' : '' }}" style="{{ @$activePage == 'solicitud' ? ' background-color: #083655; color: #fff' : '' }}">
                    <a class="nav-link" href="{{url('/indexParqueJardin')}}">
                        <i class="material-icons" style="{{ @$activePage == 'solicitud' ? 'color: #fff' : '' }}">forest</i>
                        <p>Parques y Jardines</p>
                    </a>
                </li>
            
            @endif
            
            
            @if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 6)
            <!--
                <li class="nav-item {{ (@$activePage == 'indexPrimer' || @$activePage == 'mapaPrimer' || @$activePage == 'ordenPrimer' || @$activePage == 'asistentesPrimer') ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#primer_foro" aria-expanded="{{ (@$activePage == 'indexPrimer' || @$activePage == 'mapaPrimer' || @$activePage == 'ordenPrimer' || @$activePage == 'asistentesPrimer') ? ' true' : '' }}"  style="{{ (@$activePage == 'indexPrimer' || @$activePage == 'mapaPrimer' || @$activePage == 'ordenPrimer' || @$activePage == 'asistentesPrimer') ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons {{ @$activePage == 'primer_foro' ? 'color-fbm-blue' : '' }}">safety_divider</i>
                        <p>{{ __('FORO SEGURO') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (@$activePage == 'indexPrimer' || @$activePage == 'mapaPrimer' || @$activePage == 'ordenPrimer' || @$activePage == 'asistentesPrimer') ? ' show' : '' }}" id="primer_foro">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ @$activePage == 'indexPrimer' ? ' active' : '' }}" style="{{ @$activePage == 'indexPrimer' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/primer_foro/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                             <li class="nav-item{{ @$activePage == 'mapaPrimer' ? ' active' : '' }}" style="{{ @$activePage == 'mapaPrimer' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/primer_foro/mapa')}}">
                                    <i class="material-icons">map_marker_times</i>
                                    <p>{{ __('Mapa') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesPrimer' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesPrimer' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/primer_foro/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenPrimer' ? ' active' : '' }}" style="{{ @$activePage == 'ordenPrimer' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/primer_foro/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'primerForoDashboard' ? ' active' : '' }}" style="{{ @$activePage == 'primerForoDashboard' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/primerForoDashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item {{ @$mainPage == 'sostenible' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#sanluis_sostenible" aria-expanded="{{ @$mainPage == 'sostenible' ? ' true' : '' }}"  style="{{ @$mainPage == 'sostenible' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">safety_divider</i>
                        <p>{{ __('FORO SOSTENIBLE') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'sostenible'  ? ' show' : '' }}" id="sanluis_sostenible">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'indexSostenible' || @$activePage == 'altaSostenible') ? ' active' : '' }}" style="{{ (@$activePage == 'indexSostenible' || @$activePage == 'altaSostenible') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_sostenible/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesSostenible' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesSostenible' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_sostenible/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenSostenible' ? ' active' : '' }}" style="{{ @$activePage == 'ordenSostenible' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_sostenible/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'sostenibleDashboard' ? ' active' : '' }}" style="{{ @$activePage == 'sostenibleDashboard' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/sostenibleDashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item {{ @$mainPage == 'pozos' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#pozos" aria-expanded="{{ @$mainPage == 'pozos' ? ' true' : '' }}"  style="{{ @$mainPage == 'pozos' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">safety_divider</i>
                        <p>{{ __('FORO VIILA DE POZOS') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'pozos'  ? ' show' : '' }}" id="pozos">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'indexPozos' || @$activePage == 'altaPozos') ? ' active' : '' }}" style="{{ (@$activePage == 'indexPozos' || @$activePage == 'altaPozos') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/pozos/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesPozos' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesPozos' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/pozos/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenPozos' ? ' active' : '' }}" style="{{ @$activePage == 'ordenPozos' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/pozos/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'pozosDashboard' ? ' active' : '' }}" style="{{ @$activePage == 'pozosDashboard' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/pozosDashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item {{ @$mainPage == 'bocas' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#bocas" aria-expanded="{{ @$mainPage == 'bocas' ? ' true' : '' }}"  style="{{ @$mainPage == 'bocas' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">safety_divider</i>
                        <p>{{ __('FORO BOCAS') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'bocas'  ? ' show' : '' }}" id="bocas">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'indexBocas' || @$activePage == 'altaBocas') ? ' active' : '' }}" style="{{ (@$activePage == 'indexBocas' || @$activePage == 'altaBocas') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/bocas/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesBocas' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesBocas' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/bocas/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenBocas' ? ' active' : '' }}" style="{{ @$activePage == 'ordenBocas' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/bocas/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'bocasDashboard' ? ' active' : '' }}" style="{{ @$activePage == 'bocasDashboard' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/bocasDashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item {{ @$mainPage == 'lapila' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#lapila" aria-expanded="{{ @$mainPage == 'lapila' ? ' true' : '' }}"  style="{{ @$mainPage == 'lapila' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">safety_divider</i>
                        <p>{{ __('FORO LA PILA') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'lapila'  ? ' show' : '' }}" id="lapila">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'indexLapila' || @$activePage == 'altaLapila') ? ' active' : '' }}" style="{{ (@$activePage == 'indexLapila' || @$activePage == 'altaLapila') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/lapila/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesLapila' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesLapila' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/lapila/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenLapila' ? ' active' : '' }}" style="{{ @$activePage == 'ordenLapila' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/lapila/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'pilaDashboard' ? ' active' : '' }}" style="{{ @$activePage == 'pilaDashboard' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/pilaDashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item {{ @$mainPage == 'bienestar' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#sanluis_bienestar" aria-expanded="{{ @$mainPage == 'bienestar' ? ' true' : '' }}"  style="{{ @$mainPage == 'bienestar' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">safety_divider</i>
                        <p>{{ __('FORO BIENESTAR') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'bienestar'  ? ' show' : '' }}" id="sanluis_bienestar">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'indexBienestar' || @$activePage == 'altaBienestar') ? ' active' : '' }}" style="{{ (@$activePage == 'indexBienestar' || @$activePage == 'altaBienestar') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_bienestar/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesBienestar' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesBienestar' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_bienestar/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenBienestar' ? ' active' : '' }}" style="{{ @$activePage == 'ordenBienestar' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_bienestar/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'bienestarDashboard' ? ' active' : '' }}" style="{{ @$activePage == 'bienestarDashboard' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/bienestarDashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item {{ @$mainPage == 'colonia' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#sanluis_colonia" aria-expanded="{{ @$mainPage == 'colonia' ? ' true' : '' }}"  style="{{ @$mainPage == 'colonia' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">safety_divider</i>
                        <p>{{ __('FORO COLONIA') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'colonia'  ? ' show' : '' }}" id="sanluis_colonia">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'indexColonia' || @$activePage == 'altaColonia') ? ' active' : '' }}" style="{{ (@$activePage == 'indexColonia' || @$activePage == 'altaColonia') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_colonia/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesColonia' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesColonia' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_colonia/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenColonia' ? ' active' : '' }}" style="{{ @$activePage == 'ordenColonia' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_colonia/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'coloniaDashboard' ? ' active' : '' }}" style="{{ @$activePage == 'coloniaDashboard' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/coloniaDashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item {{ @$mainPage == 'jardin_arte' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#jardin_arte" aria-expanded="{{ @$mainPage == 'jardin_arte' ? ' true' : '' }}"  style="{{ @$mainPage == 'jardin_arte' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">safety_divider</i>
                        <p>{{ __('FORO JARDIN DEL ARTE') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'jardin_arte'  ? ' show' : '' }}" id="jardin_arte">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'indexJardinArte' || @$activePage == 'altaJardinArte') ? ' active' : '' }}" style="{{ (@$activePage == 'indexJardinArte' || @$activePage == 'altaJardinArte') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/jardinArte/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesJardinArte' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesJardinArte' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/jardinArte/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenJardinArte' ? ' active' : '' }}" style="{{ @$activePage == 'ordenJardinArte' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/jardinArte/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'jardinArteDashboard' ? ' active' : '' }}" style="{{ @$activePage == 'jardinArteDashboard' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/jardinArteDashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>-->
            @endif
            
            @if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 6  || \Auth::User()->id == 72)
            <!--
                <li class="nav-item {{ @$mainPage == 'competitivo' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#sanluis_competitivo" aria-expanded="{{ @$mainPage == 'competitivo' ? ' true' : '' }}"  style="{{ @$mainPage == 'competitivo' ? ' background-color: #083655; color: #fff' : '' }}">
                        <i class="material-icons">safety_divider</i>
                        <p>{{ __('FORO COMPETITIVO') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ @$mainPage == 'competitivo'  ? ' show' : '' }}" id="sanluis_competitivo">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item{{ (@$activePage == 'indexCompetitivo' || @$activePage == 'altaCompetitivo') ? ' active' : '' }}" style="{{ (@$activePage == 'indexCompetitivo' || @$activePage == 'altaCompetitivo') ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_competitivo/index')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Invitados') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'asistentesCompetitivo' ? ' active' : '' }}" style="{{ @$activePage == 'asistentesCompetitivo' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_competitivo/asistentes')}}">
                                    <i class="material-icons">people</i>
                                    <p>{{ __('Asistentes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'ordenCompetitivo' ? ' active' : '' }}" style="{{ @$activePage == 'ordenCompetitivo' ? ' background-color: #28628a' : '' }}">
                                <a class="nav-link" href="{{url('/sanluis_competitivo/ordendia')}}">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p>{{ __('Órden del día') }}</p>
                                </a>
                            </li>
                            <li class="nav-item{{ @$activePage == 'competitivoDashboard' ? ' active' : '' }}" style="{{ @$activePage == 'competitivoDashboard' ? ' background-color: #28628a' : '' }}">
    							<a class="nav-link" href="{{url('/competitivoDashboard')}}">
    							    <i class="material-icons">pie_chart</i>
    								<p>{{ __('Dashboard') }}</p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li> -->
                @endif
            @endif
        @endif
        </ul>
    </div>
</div>
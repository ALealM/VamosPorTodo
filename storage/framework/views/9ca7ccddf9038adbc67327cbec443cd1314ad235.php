<div class="sidebar" data-color="" data-background-color="white" >
    <div class="logo text-center">
        <a href="/" class="simple-text logo-mini">
            INFO
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
                <li class="nav-item <?php echo e(@$activePage == 'inicio' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'inicio' ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>">
                        <i class="material-icons" style="<?php echo e(@$activePage == 'inicio' ? 'color: #fff' : ''); ?>">home</i>
                        <p>Inicio</p>
                    </a>
                </li>
                <?php if(\Auth::User()->tipo == 12): ?>
                <li class="nav-item <?php echo e((@$activePage == 'panel') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'panel' ) ? ' background-color: #083655; color: #fff' : ''); ?>">
                <a class="nav-link" href="<?php echo e(url('/panelAc')); ?>">
                    <i class="material-icons" style="<?php echo e((@$activePage == 'panel') ? 'color: #fff' : ''); ?>">view_day</i>
                    <p>Panel</p>
                </a>
            </li>
            <li class="nav-item <?php echo e((@$activePage == 'acciones') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'acciones') ? ' background-color: #083655; color: #fff' : ''); ?>">
                <a class="nav-link" href="<?php echo e(url('/lineasAccion')); ?>">
                    <i class="material-icons" style="<?php echo e((@$activePage == 'acciones') ? 'color: #fff' : ''); ?>">backup_table</i>
                    <p>Acciones</p>
                </a>
            </li>
            <li class="nav-item <?php echo e(@$mainPage == 'unidades' ? ' active' : ''); ?>">
                <a class="nav-link" data-toggle="collapse" href="#unidades" aria-expanded="<?php echo e(@$mainPage == 'unidades' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'unidades' ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <i class="material-icons">file_copy</i>
                    <p><?php echo e(__('Catálogos')); ?>

                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse <?php echo e(@$mainPage == 'unidades' ? ' show' : ''); ?>" id="unidades">
                    <ul class="nav" style="margin-top:0px; background-color: #eee">
                        <li class="nav-item<?php echo e((@$activePage == 'unidades') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'unidades') ? ' background-color: #28628a' : ''); ?>">
                            <a class="nav-link" href="<?php echo e(url('/catalogos/unidades')); ?>">
                                <i class="material-icons">file_copy</i>
                                <p><?php echo e(__('Unidades')); ?></p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php else: ?>
            <?php if(\Auth::User()->tipo == 0 ||  \Auth::User()->tipo == 4): ?>
                <li class="nav-item <?php echo e((@$activePage == 'acciones') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'acciones') ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/acciones')); ?>">
                        <i class="material-icons" style="<?php echo e((@$activePage == 'acciones') ? 'color: #fff' : ''); ?>">task_alt</i>
                        <p>Acciones Municipales</p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if( \Auth::User()->tipo == 0 ||  \Auth::User()->tipo == 11 ||  \Auth::User()->tipo == 4 ): ?>
                <li class="nav-item <?php echo e(@$mainPage == 'nomina' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#nomina" aria-expanded="<?php echo e(@$mainPage == 'nomina' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'nomina' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">paid</i>
                        <p><?php echo e(__('Nómina')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'nomina' ? ' show' : ''); ?>" id="nomina">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <?php if( \Auth::User()->tipo != 4 ): ?>
                            <li class="nav-item<?php echo e((@$activePage == 'carga') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'carga') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/cargaNomina')); ?>">
                                    <i class="material-icons"> backup </i>
                                    <p><?php echo e(__('Carga')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e((@$activePage == 'cambioss') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'cambioss') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/nominaAB')); ?>">
                                    <i class="material-icons"> call_split </i>
                                    <p><?php echo e(__('Cambios/Altas/Bajas')); ?></p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item<?php echo e((@$activePage == 'consulta') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'consulta') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/nomina')); ?>">
                                    <i class="material-icons"> list </i>
                                    <p><?php echo e(__('Consulta')); ?></p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if(\Auth::User()->tipo == 0): ?>
                <li class="nav-item <?php echo e((@$activePage == 'juntas') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'juntas') ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/juntas')); ?>">
                        <i class="material-icons" style="<?php echo e((@$activePage == 'juntas') ? 'color: #fff' : ''); ?>">groups</i>
                        <p>Juntas Participación Ciudadana</p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(\Auth::User()->tipo == 10 || \Auth::User()->tipo == 0 || \Auth::User()->id == 74): ?>
                <li class="nav-item <?php echo e(@$mainPage == 'programas' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#programas" aria-expanded="<?php echo e(@$mainPage == 'programas' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'programas' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">supervised_user_circle</i>
                        <p><?php echo e(__('Programas Sociales')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'programas' ? ' show' : ''); ?>" id="programas">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'solicitudes') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'solicitudes') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/solicitudes')); ?>">
                                    <i class="material-icons"> list_alt </i>
                                    <p><?php echo e(__('Solicitudes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e((@$activePage == 'padron') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'padron') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/padronBeneficiarios')); ?>">
                                    <i class="material-icons"> accessibility </i>
                                    <p><?php echo e(__('Padrón de Beneficiarios')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e((@$activePage == 'colonias') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'colonias') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/colonias')); ?>">
                                    <i class="material-icons"> assignment </i>
                                    <p><?php echo e(__('Colonias')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e((@$activePage == 'rubros') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'rubros') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/rubros')); ?>">
                                    <i class="material-icons"> assignment </i>
                                    <p><?php echo e(__('Rubros')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e((@$activePage == 'programas') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'programas') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/programas')); ?>">
                                    <i class="material-icons"> assignment </i>
                                    <p><?php echo e(__('Programas')); ?></p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            
            <?php if(\Auth::User()->tipo == 1): ?>
                <li class="nav-item <?php echo e((@$activePage == 'Indicadores') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'Indicadores') ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/indicadores')); ?>">
                        <i class="material-icons" style="<?php echo e((@$activePage == 'Indicadores') ? 'color: #fff' : ''); ?>">trending_up</i>
                        <p>Indicadores</p>
                    </a>
                </li>
            <?php endif; ?>
           
            <?php if(\Auth::User()->id == 2): ?>
                <li class="nav-item <?php echo e((@$activePage == 'contratos') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'contratos') ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/contratos')); ?>">
                        <i class="material-icons" style="<?php echo e((@$activePage == 'contratos') ? 'color: #fff' : ''); ?>">work</i>
                        <p>Contratos</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e((@$activePage == 'convenios') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'convenios') ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/convenios')); ?>">
                        <i class="material-icons" style="<?php echo e((@$activePage == 'convenios') ? 'color: #fff' : ''); ?>">handshake</i>
                        <p>Convenios</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(@$activePage == 'servMunic' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'servMunic' ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/indexServiciosMunicipales')); ?>">
                        <i class="material-icons" style="<?php echo e(@$activePage == 'servMunic' ? 'color: #fff' : ''); ?>">business</i>
                        <p>Servicios Municipales</p>
                    </a>
                </li>
            
                <li class="nav-item <?php echo e(@$activePage == 'ecologia' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ecologia' ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/indexEcologia')); ?>">
                        <i class="material-icons" style="<?php echo e(@$activePage == 'ecologia' ? 'color: #fff' : ''); ?>">wb_sunny </i>
                        <p>Ecología</p>
                    </a>
                </li>
            <?php endif; ?>
            
            
           
            <?php if( in_array( \Auth::User()->id, [2] ) ): ?>
            <!-- 6,67 -->
            
                <li class="nav-item <?php echo e(@$activePage == 'portada' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'portada' ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/portadaAreasAtencion')); ?>">
                        <i class="material-icons" style="<?php echo e(@$activePage == 'portada' ? 'color: #fff' : ''); ?>"> face-agent </i>
                        <p> Áreas de Atención </p>
                    </a>
                </li>
            <?php endif; ?>
           
           
           
           
             
             
             
            <?php if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 4): ?>
                <li class="nav-item <?php echo e((@$activePage == 'panel' || @$activePage == 'showID' || @$activePage == 'showEV' || @$activePage == 'showPOA') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'panel' || @$activePage == 'showID' || @$activePage == 'showEV' || @$activePage == 'showPOA') ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/panel')); ?>">
                        <i class="material-icons" style="<?php echo e((@$activePage == 'panel' || @$activePage == 'showID' || @$activePage == 'showEV' || @$activePage == 'showPOA') ? 'color: #fff' : ''); ?>">view_day</i>
                        <p>Panel</p>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if(\Auth::User()->tipo < 3): ?>
                <li class="nav-item <?php echo e((@$activePage == 'proyectoAccion' || @$activePage == 'createProyectoAccion' || @$activePage == 'showProyectoAccion' || @$activePage == 'editProyectoAccion') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'proyectoAccion' || @$activePage == 'createProyectoAccion' || @$activePage == 'showProyectoAccion' || @$activePage == 'editProyectoAccion') ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/proyectoAccion/listado')); ?>">
                        <i class="material-icons" style="<?php echo e((@$activePage == 'proyectoAccion' || @$activePage == 'createProyectoAccion' || @$activePage == 'showProyectoAccion' || @$activePage == 'editProyectoAccion') ? 'color: #fff' : ''); ?>">backup_table</i>
                        <p>Proyectos y Acciones</p>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if(\Auth::User()->tipo == 0): ?>
                <li class="nav-item <?php echo e(@$mainPage == 'agenda' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#agenda" aria-expanded="<?php echo e(@$mainPage == 'agenda' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'agenda' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">fact_check</i>
                        <p><?php echo e(__('AGENDA ESTRATÉGICA')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'agenda' ? ' show' : ''); ?>" id="agenda">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'agendaCreate') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'agendaCreate') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/agenda/create')); ?>">
                                    <i class="material-icons"> class </i>
                                    <p><?php echo e(__('Nueva')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e((@$activePage == 'agenda') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'agenda') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/agenda/listado')); ?>">
                                    <i class="material-icons"> assignment </i>
                                    <p><?php echo e(__('Todas')); ?></p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if( \Auth::User()->tipo == 11): ?>
                <li class="nav-item <?php echo e(@$mainPage == 'informe' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#informe" aria-expanded="<?php echo e(@$mainPage == 'informe' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'informe' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">history_edu</i>
                        <p><?php echo e(__('INFORME DIARIO')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'informe' ? ' show' : ''); ?>" id="informe">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'informe' || @$activePage == 'createInforme' || @$activePage == 'showInforme' || @$activePage == 'editInforme') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'informe' || @$activePage == 'createInforme' || @$activePage == 'showInforme' || @$activePage == 'editInforme') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/informe/listado')); ?>">
                                    <i class="material-icons">history_edu</i>
                                    <p><?php echo e(__('Informe Diario')); ?></p>
                                </a>
                            </li>
                            <?php if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 3 || \Auth::User()->id ==74  ||  \Auth::User()->tipo == 11 ): ?>
                            <li class="nav-item<?php echo e((@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/informe/listadoRevision')); ?>">
                                    <i class="material-icons">file_copy</i>
                                    <p><?php echo e(__('Informes Diarios')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'informeResumen' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'informeResumen' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/informe/resumen')); ?>">
                                    <i class="material-icons">speaker_notes</i>
                                    <p><?php echo e(__('Resumen Informes Diarios')); ?></p>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
        <?php if(\Auth::User()->tipo < 10): ?>
                <li class="nav-item <?php echo e(@$mainPage == 'eventos' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#eventos" aria-expanded="<?php echo e(@$mainPage == 'eventos' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'eventos' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">star_rate</i>
                        <p><?php echo e(__('EVENTOS')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'eventos' ? ' show' : ''); ?>" id="eventos">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <?php if(\Auth::User()->tipo < 3 || \Auth::User()->tipo ==5): ?>
                                <li class="nav-item<?php echo e((@$activePage == 'eventos'|| @$activePage == 'showEvento' || @$activePage == 'editEvento' || @$activePage == 'showObservaciones' || @$activePage == 'createEvento') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'eventos' || @$activePage == 'showEvento' || @$activePage == 'editEvento' || @$activePage == 'showObservaciones' || @$activePage == 'createEvento') ? ' background-color: #28628a' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/eventos/listado')); ?>">
                                        <i class="material-icons">star_rate</i>
                                        <p><?php echo e(__('Eventos')); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item<?php echo e((@$activePage == 'eventosColaboracion' || @$activePage == 'showColaboracionEvento') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'eventosColaboracion' || @$activePage == 'showColaboracionEvento') ? ' background-color: #28628a' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/eventosColaboracion/listado')); ?>">
                                        <i class="material-icons">people</i>
                                        <p><?php echo e(__('Eventos en Colaboración')); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item<?php echo e((@$activePage == 'eventosAutorizados' || @$activePage == 'showAutorizadoEvento' || @$activePage == 'reporteEvento' || @$activePage == 'reporteEventoColaboracion') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'eventosAutorizados' || @$activePage == 'showAutorizadoEvento' || @$activePage == 'reporteEvento' || @$activePage == 'reporteEventoColaboracion') ? ' background-color: #28628a' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/eventos/listadoAutorizado')); ?>">
                                        <i class="material-icons">how_to_reg</i>
                                        <p><?php echo e(__('Eventos Autorizados')); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item<?php echo e((@$activePage == 'eventosDiariosUpdate' ) ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'eventosDiariosUpdate') ? ' background-color: #28628a' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/eventosDiariosUpdate')); ?>">
                                        <i class="material-icons">edit_note</i>
                                        <p><?php echo e(__('a Actualizar')); ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>
                                <li class="nav-item<?php echo e((@$activePage == 'calendarioEventosDiarios' ) ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'calendarioEventosDiarios') ? ' background-color: #28628a' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('/calendarioEventosDiarios')); ?>">
                                        <i class="material-icons">calendar_month</i>
                                        <p><?php echo e(__('Calendario')); ?></p>
                                    </a>
                                </li>
                        </ul>
                    </div>
                </li>
            
            <?php if(\Auth::User()->tipo < 4 || \Auth::User()->tipo ==5 || \Auth::User()->id ==74  ||  \Auth::User()->tipo == 11): ?>
                <li class="nav-item <?php echo e(@$mainPage == 'informe' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#informe" aria-expanded="<?php echo e(@$mainPage == 'informe' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'informe' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">history_edu</i>
                        <p><?php echo e(__('INFORME DIARIO')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'informe' ? ' show' : ''); ?>" id="informe">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'informe' || @$activePage == 'createInforme' || @$activePage == 'showInforme' || @$activePage == 'editInforme') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'informe' || @$activePage == 'createInforme' || @$activePage == 'showInforme' || @$activePage == 'editInforme') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/informe/listado')); ?>">
                                    <i class="material-icons">history_edu</i>
                                    <p><?php echo e(__('Informe Diario')); ?></p>
                                </a>
                            </li>
                            <?php if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 3 || \Auth::User()->id ==74  ||  \Auth::User()->tipo == 11 ): ?>
                            <li class="nav-item<?php echo e((@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/informe/listadoRevision')); ?>">
                                    <i class="material-icons">file_copy</i>
                                    <p><?php echo e(__('Informes Diarios')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'informeResumen' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'informeResumen' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/informe/resumen')); ?>">
                                    <i class="material-icons">speaker_notes</i>
                                    <p><?php echo e(__('Resumen Informes Diarios')); ?></p>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            
            <?php if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 1 || \Auth::User()->id == 74): ?>
                <li class="nav-item <?php echo e((@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#acuerdos" aria-expanded="<?php echo e((@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' true' : ''); ?>"  style="<?php echo e((@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">spellcheck</i>
                        <p><?php echo e(__('ACUERDOS')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e((@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' show' : ''); ?>" id="acuerdos">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'acuerdo' || @$activePage == 'peticionIndex' || @$activePage == 'createAcuerdo' || @$activePage == 'editAcuerdo' || @$activePage == 'showAcuerdo' || @$activePage == 'listado' || @$activePage == 'createlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo' || @$activePage == 'showlistadoAcuerdo' || @$activePage == 'editlistadoAcuerdo') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/peticion/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Reuniones solicitadas')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e((@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'listadoRevision' || @$activePage == 'showRevision' || @$activePage == 'revisarInforme') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/peticion/listado')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Reuniones para autorizar')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'informeResumen' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'informeResumen' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/peticion/responsable/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Acuerdos responsables')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'informeResumen' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'informeResumen' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/peticion/colaborador/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Acuerdos colaboradores')); ?></p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            
            <?php if(\Auth::User()->tipo == 0 ): ?>
                <li class="nav-item <?php echo e((@$activePage == 'dashboardInvitados' || @$activePage == 'indexInvitados' || @$activePage == 'mapaInvitados' || @$activePage == 'ordenInvitados' || @$activePage == 'asistentesInvitados') ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#invitados" aria-expanded="<?php echo e((@$activePage == 'indexInvitados' || @$activePage == 'mapaInvitados' || @$activePage == 'ordenInvitados' || @$activePage == 'asistentesInvitados') ? ' true' : ''); ?>"  style="<?php echo e((@$activePage == 'dashboardInvitados' || @$activePage == 'indexInvitados' || @$activePage == 'mapaInvitados' || @$activePage == 'ordenInvitados' || @$activePage == 'asistentesInvitados') ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">groups</i>
                        <p><?php echo e(__('INVITADOS CONSEJOS')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e((@$activePage == 'dashboardInvitados' || @$activePage == 'indexInvitados' || @$activePage == 'mapaInvitados' || @$activePage == 'ordenInvitados' || @$activePage == 'asistentesInvitados') ? ' show' : ''); ?>" id="invitados">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e(@$activePage == 'indexInvitados' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'indexInvitados' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/invitados/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'mapaInvitados' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'mapaInvitados' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/invitados/mapa')); ?>">
                                    <i class="material-icons">map_marker_times</i>
                                    <p><?php echo e(__('Mapa')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesInvitados' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesInvitados' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/invitados/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenInvitados' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenInvitados' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/invitados/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'dashboardInvitados' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'dashboardInvitados' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/invitados/dashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
            
                <li class="nav-item <?php echo e(@$activePage == 'indicador' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'indicador' ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/indexFichaIndicadores')); ?>">
                        <i class="material-icons" style="<?php echo e(@$activePage == 'indicador' ? 'color: #fff' : ''); ?>">book</i>
                        <p>Ficha Indicadores de Desempeño</p>
                    </a>
                </li>
            
                <li class="nav-item <?php echo e(@$activePage == 'solicitud' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'solicitud' ? ' background-color: #083655; color: #fff' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/indexParqueJardin')); ?>">
                        <i class="material-icons" style="<?php echo e(@$activePage == 'solicitud' ? 'color: #fff' : ''); ?>">forest</i>
                        <p>Parques y Jardines</p>
                    </a>
                </li>
            
            <?php endif; ?>
            
            
            <?php if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 6): ?>
            <!--
                <li class="nav-item <?php echo e((@$activePage == 'indexPrimer' || @$activePage == 'mapaPrimer' || @$activePage == 'ordenPrimer' || @$activePage == 'asistentesPrimer') ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#primer_foro" aria-expanded="<?php echo e((@$activePage == 'indexPrimer' || @$activePage == 'mapaPrimer' || @$activePage == 'ordenPrimer' || @$activePage == 'asistentesPrimer') ? ' true' : ''); ?>"  style="<?php echo e((@$activePage == 'indexPrimer' || @$activePage == 'mapaPrimer' || @$activePage == 'ordenPrimer' || @$activePage == 'asistentesPrimer') ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons <?php echo e(@$activePage == 'primer_foro' ? 'color-fbm-blue' : ''); ?>">safety_divider</i>
                        <p><?php echo e(__('FORO SEGURO')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e((@$activePage == 'indexPrimer' || @$activePage == 'mapaPrimer' || @$activePage == 'ordenPrimer' || @$activePage == 'asistentesPrimer') ? ' show' : ''); ?>" id="primer_foro">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e(@$activePage == 'indexPrimer' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'indexPrimer' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/primer_foro/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                             <li class="nav-item<?php echo e(@$activePage == 'mapaPrimer' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'mapaPrimer' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/primer_foro/mapa')); ?>">
                                    <i class="material-icons">map_marker_times</i>
                                    <p><?php echo e(__('Mapa')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesPrimer' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesPrimer' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/primer_foro/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenPrimer' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenPrimer' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/primer_foro/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'primerForoDashboard' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'primerForoDashboard' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/primerForoDashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item <?php echo e(@$mainPage == 'sostenible' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#sanluis_sostenible" aria-expanded="<?php echo e(@$mainPage == 'sostenible' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'sostenible' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">safety_divider</i>
                        <p><?php echo e(__('FORO SOSTENIBLE')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'sostenible'  ? ' show' : ''); ?>" id="sanluis_sostenible">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'indexSostenible' || @$activePage == 'altaSostenible') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'indexSostenible' || @$activePage == 'altaSostenible') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_sostenible/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesSostenible' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesSostenible' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_sostenible/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenSostenible' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenSostenible' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_sostenible/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'sostenibleDashboard' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'sostenibleDashboard' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/sostenibleDashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item <?php echo e(@$mainPage == 'pozos' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#pozos" aria-expanded="<?php echo e(@$mainPage == 'pozos' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'pozos' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">safety_divider</i>
                        <p><?php echo e(__('FORO VIILA DE POZOS')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'pozos'  ? ' show' : ''); ?>" id="pozos">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'indexPozos' || @$activePage == 'altaPozos') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'indexPozos' || @$activePage == 'altaPozos') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/pozos/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesPozos' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesPozos' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/pozos/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenPozos' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenPozos' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/pozos/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'pozosDashboard' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'pozosDashboard' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/pozosDashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item <?php echo e(@$mainPage == 'bocas' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#bocas" aria-expanded="<?php echo e(@$mainPage == 'bocas' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'bocas' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">safety_divider</i>
                        <p><?php echo e(__('FORO BOCAS')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'bocas'  ? ' show' : ''); ?>" id="bocas">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'indexBocas' || @$activePage == 'altaBocas') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'indexBocas' || @$activePage == 'altaBocas') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/bocas/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesBocas' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesBocas' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/bocas/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenBocas' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenBocas' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/bocas/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'bocasDashboard' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'bocasDashboard' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/bocasDashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item <?php echo e(@$mainPage == 'lapila' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#lapila" aria-expanded="<?php echo e(@$mainPage == 'lapila' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'lapila' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">safety_divider</i>
                        <p><?php echo e(__('FORO LA PILA')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'lapila'  ? ' show' : ''); ?>" id="lapila">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'indexLapila' || @$activePage == 'altaLapila') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'indexLapila' || @$activePage == 'altaLapila') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/lapila/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesLapila' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesLapila' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/lapila/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenLapila' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenLapila' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/lapila/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'pilaDashboard' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'pilaDashboard' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/pilaDashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item <?php echo e(@$mainPage == 'bienestar' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#sanluis_bienestar" aria-expanded="<?php echo e(@$mainPage == 'bienestar' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'bienestar' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">safety_divider</i>
                        <p><?php echo e(__('FORO BIENESTAR')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'bienestar'  ? ' show' : ''); ?>" id="sanluis_bienestar">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'indexBienestar' || @$activePage == 'altaBienestar') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'indexBienestar' || @$activePage == 'altaBienestar') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_bienestar/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesBienestar' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesBienestar' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_bienestar/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenBienestar' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenBienestar' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_bienestar/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'bienestarDashboard' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'bienestarDashboard' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/bienestarDashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item <?php echo e(@$mainPage == 'colonia' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#sanluis_colonia" aria-expanded="<?php echo e(@$mainPage == 'colonia' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'colonia' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">safety_divider</i>
                        <p><?php echo e(__('FORO COLONIA')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'colonia'  ? ' show' : ''); ?>" id="sanluis_colonia">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'indexColonia' || @$activePage == 'altaColonia') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'indexColonia' || @$activePage == 'altaColonia') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_colonia/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesColonia' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesColonia' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_colonia/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenColonia' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenColonia' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_colonia/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'coloniaDashboard' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'coloniaDashboard' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/coloniaDashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item <?php echo e(@$mainPage == 'jardin_arte' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#jardin_arte" aria-expanded="<?php echo e(@$mainPage == 'jardin_arte' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'jardin_arte' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">safety_divider</i>
                        <p><?php echo e(__('FORO JARDIN DEL ARTE')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'jardin_arte'  ? ' show' : ''); ?>" id="jardin_arte">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'indexJardinArte' || @$activePage == 'altaJardinArte') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'indexJardinArte' || @$activePage == 'altaJardinArte') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/jardinArte/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesJardinArte' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesJardinArte' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/jardinArte/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenJardinArte' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenJardinArte' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/jardinArte/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'jardinArteDashboard' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'jardinArteDashboard' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/jardinArteDashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li>-->
            <?php endif; ?>
            
            <?php if(\Auth::User()->tipo == 0 || \Auth::User()->tipo == 6  || \Auth::User()->id == 72): ?>
            <!--
                <li class="nav-item <?php echo e(@$mainPage == 'competitivo' ? ' active' : ''); ?>">
                    <a class="nav-link" data-toggle="collapse" href="#sanluis_competitivo" aria-expanded="<?php echo e(@$mainPage == 'competitivo' ? ' true' : ''); ?>"  style="<?php echo e(@$mainPage == 'competitivo' ? ' background-color: #083655; color: #fff' : ''); ?>">
                        <i class="material-icons">safety_divider</i>
                        <p><?php echo e(__('FORO COMPETITIVO')); ?>

                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?php echo e(@$mainPage == 'competitivo'  ? ' show' : ''); ?>" id="sanluis_competitivo">
                        <ul class="nav" style="margin-top:0px; background-color: #eee">
                            <li class="nav-item<?php echo e((@$activePage == 'indexCompetitivo' || @$activePage == 'altaCompetitivo') ? ' active' : ''); ?>" style="<?php echo e((@$activePage == 'indexCompetitivo' || @$activePage == 'altaCompetitivo') ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_competitivo/index')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Invitados')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'asistentesCompetitivo' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'asistentesCompetitivo' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_competitivo/asistentes')); ?>">
                                    <i class="material-icons">people</i>
                                    <p><?php echo e(__('Asistentes')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'ordenCompetitivo' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'ordenCompetitivo' ? ' background-color: #28628a' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/sanluis_competitivo/ordendia')); ?>">
                                    <i class="material-icons">format_list_bulleted</i>
                                    <p><?php echo e(__('Órden del día')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo e(@$activePage == 'competitivoDashboard' ? ' active' : ''); ?>" style="<?php echo e(@$activePage == 'competitivoDashboard' ? ' background-color: #28628a' : ''); ?>">
    							<a class="nav-link" href="<?php echo e(url('/competitivoDashboard')); ?>">
    							    <i class="material-icons">pie_chart</i>
    								<p><?php echo e(__('Dashboard')); ?></p>
    							</a>
    						</li>
                        </ul>
                    </div>
                </li> -->
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        </ul>
    </div>
</div>
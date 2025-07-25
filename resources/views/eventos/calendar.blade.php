@extends('layouts.app', ['activePage' => 'calendarioEventosDiarios', 'mainPage' => 'eventos'])
@section('title', 'Main page')

@section('content')

	<!-- Fullcalendar css-->
	<link href="{{URL::asset('assets/plugins/fullcalendar/fullcalendar.css')}}" rel='stylesheet' />
	<link href="{{URL::asset('assets/plugins/fullcalendar/fullcalendar.print.min.css')}}" rel='stylesheet' media='print' />
	<style type="text/css">
		.fc-list-day-side-text, .fc-col-header-cell-cushion, .fc-col-header-cell-cushion, .fc-toolbar-title, .fc-list-day-text { text-transform: uppercase; }
		.fc-event-start { color: '#fff'; }
	</style>

	<!-- Row -->
	<div class="row row-sm">
	    <div class="col-sm-12 col-md-12">
	        <div class="card custom-card">
	            <div class="card-body">
	                <div class="row "id="wrap">
	                    <div class="col-xl-1" id="external-events-list"> </div>
	                    <div class="col-xl-10" id="calendar-wrap">
	                        <div id="calendar"></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- End Row -->

	<!-- Modal -->
	<div aria-hidden="true" class="modal custom-card" id="infoEvento" role="dialog" style="border-top-left-radius: 2em; border-top-right-radius: 2em;">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h6 class="modal-title tx-white tx-medium" id="titleInfoEvento">Información del evento</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="modalEvento">
                    
                </div>
            </div>
        </div>
    </div>
	<!-- /Modal -->

	<script type="text/javascript">
	    //Full Calendar
	    document.addEventListener('DOMContentLoaded', function() {
	        var calendarEl = document.getElementById('calendar');
	        var calendar = new FullCalendar.Calendar(calendarEl, {
	            headerToolbar: {
	                left: 'prev,next today',
	                center: 'title',
	                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
	            },
	            locale: 'es',
	            eventClick: function(arg) { // Select the event
	                $.get(BASE_URL + "getEventoDiario", { 'id': arg.event._def.publicId }, function (r) {
	                    $('#modalEvento').html(r);
	                    //$('#titleInfoEvento').html(r.titulo);
	                    //$('#fechaInfoEvento').html(r.fecha);
	                    //$('#direccionInfoEvento').html(r.lugar);
	                });
	                arg.el.setAttribute('data-target', '#infoEvento');
	                arg.el.setAttribute('data-toggle', 'modal');
	                return false;
	            },
	            editable: false,
	            dayMaxEvents: true, // allow "more" link when too many events
	            events: [
	                @foreach($eventos as $evento){
	                    title: '@if( $evento-> asistencia_presidente ) <img src="img/cuadros.png" style="width:10px"> @endif {!! str_replace("\r\n", " ", $evento->titulo) !!}',
	                    start: '{{ $evento->fecha.($evento->hora_inicio ? "T".$evento->hora_inicio : "") }}',
	                    @if( $evento->hora_inicio ) end: "{{ $evento->fecha.'T'.$evento->hora_fin.':00' }}", @endif
	                    id: {{ $evento->id }},
	                    textColor: "#fff",
	                    background: "linear-gradient(to right, {{ $evento->color }} 90%, @switch($evento->semaforo) @case(1) #dc3545 @break @case(2) #ffc107 @break @case(3) #28a745 @break @default {{ $evento->color }} @break @endswitch 10%)",
	                    //borderColor: "linear-gradient(90deg, {{ $evento->color }} 80%, {{ $evento->color }} 20%)",
	                    description: '{!! $evento->evento !!} Por: {!! $evento->direccion !!}'
	                } 
	                @if (!$loop->last), @endif
	                @endforeach
	            ],
	            eventDidMount: function(info) {
	                if (info.event.extendedProps.background) {
	                    info.el.style.background = info.event.extendedProps.background;
	                    info.el.style.borderColor = info.event.extendedProps.borderColor;
	                }
	            },
				eventContent: function(arg) {
				    let arrayOfDomNodes = []
				    // title event
				    let titleEvent = document.createElement('div')
				    if(arg.event._def.title) { titleEvent.style.padding = "0 0 0 1em"
				      titleEvent.innerHTML = arg.event._def.title
				      titleEvent.classList = "fc-event-title fc-sticky text-white"
				    }

				    // image event
				    let imgEventWrap = document.createElement('div')
				    if(arg.event.extendedProps.image_url) {
				      let imgEvent = '<img src="'+arg.event.extendedProps.image_url+'" style="width:10px">'
				      imgEventWrap.classList = "fc-event-img"
				      imgEventWrap.innerHTML = imgEvent;
				    }

				    arrayOfDomNodes = [ titleEvent,imgEventWrap ]

				    return { domNodes: arrayOfDomNodes }
				}
	        });
	        calendar.render();
	    });
	</script>
	<!-- Moment js-->
	<script src="{{URL::asset('assets/plugins/moment/min/moment.min.js')}}"></script>

	<!-- Full-calendar js-->
	<script src="{{URL::asset('assets/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
@endsection
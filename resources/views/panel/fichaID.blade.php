@extends('layouts.app', ['activePage' => 'showID'])
@section('title', 'Main page')
@section('content')
<style>
    
    /*
    code by Iatek LLC 2018 - CC 2.0 License - Attribution required
    code customized by Azmind.com
*/
@media (min-width: 768px) and (max-width: 991px) {
    /* Show 4th slide on md if col-md-4*/
    .carousel-inner .active.col-md-4.carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: absolute;
        top: 0;
        right: -33.3333%;  /*change this with javascript in the future*/
        z-index: -1;
        display: block;
        visibility: visible;
    }
}
@media (min-width: 576px) and (max-width: 768px) {
    /* Show 3rd slide on sm if col-sm-6*/
    .carousel-inner .active.col-sm-6.carousel-item + .carousel-item + .carousel-item {
        position: absolute;
        top: 0;
        right: -50%;  /*change this with javascript in the future*/
        z-index: -1;
        display: block;
        visibility: visible;
    }
}
@media (min-width: 576px) {
    .carousel-item {
        margin-right: 0;
    }
    /* show 2 items */
    .carousel-inner .active + .carousel-item {
        display: block;
    }
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item {
        transition: none;
    }
    .carousel-inner .carousel-item-next {
        position: relative;
        transform: translate3d(0, 0, 0);
    }
    /* left or forward direction */
    .active.carousel-item-left + .carousel-item-next.carousel-item-left,
    .carousel-item-next.carousel-item-left + .carousel-item,
    .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(-100%, 0, 0);
        visibility: visible;
    }
    /* farthest right hidden item must be also positioned for animations */
    .carousel-inner .carousel-item-prev.carousel-item-right {
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        display: block;
        visibility: visible;
    }
    /* right or prev direction */
    .active.carousel-item-right + .carousel-item-prev.carousel-item-right,
    .carousel-item-prev.carousel-item-right + .carousel-item,
    .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(100%, 0, 0);
        visibility: visible;
        display: block;
        visibility: visible;
    }
}
/* MD */
@media (min-width: 768px) {
    /* show 3rd of 3 item slide */
    .carousel-inner .active + .carousel-item + .carousel-item {
        display: block;
    }
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item {
        transition: none;
    }
    .carousel-inner .carousel-item-next {
        position: relative;
        transform: translate3d(0, 0, 0);
    }
    /* left or forward direction */
    .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(-100%, 0, 0);
        visibility: visible;
    }
    /* right or prev direction */
    .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(100%, 0, 0);
        visibility: visible;
        display: block;
        visibility: visible;
    }
}
/* LG */
@media (min-width: 991px) {
    /* show 4th item */
    .carousel-inner .active + .carousel-item + .carousel-item + .carousel-item {
        display: block;
    }
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item + .carousel-item {
        transition: none;
    }
    /* Show 5th slide on lg if col-lg-3 */
    .carousel-inner .active.col-lg-3.carousel-item + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: absolute;
        top: 0;
        right: -25%;  /*change this with javascript in the future*/
        z-index: -1;
        display: block;
        visibility: visible;
    }
    /* left or forward direction */
    .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(-100%, 0, 0);
        visibility: visible;
    }
    /* right or prev direction //t - previous slide direction last item animation fix */
    .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(100%, 0, 0);
        visibility: visible;
        display: block;
        visibility: visible;
    }
}
</style>
<div class="row">
    <div class="col-md-12">
        <div id="accordion">
            @foreach($informes as $informe)
            <div class="card" style="margin-top: 15px;margin-bottom: 15px;">
                <div class="card-header" id="heading{{$informe->id}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link {{($informe->id==$idx) ? '' : 'collapsed'}}" data-toggle="collapse" data-target="#collapse{{$informe->id}}" aria-expanded="{{($informe->id==$idx) ? 'true' : ''}}" aria-controls="collapse{{$informe->id}}" style="padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 0px; padding: 0px;">
                            <h4 style="margin-bottom: 0px;">{{$informe->direccion()->direccion}}</h4>
                        </button>
                    </h5>
                </div>
                <div id="collapse{{$informe->id}}" class="collapse {{($informe->id==$idx) ? 'show' : ''}}" aria-labelledby="heading{{$informe->id}}" data-parent="#accordion">
                    <div class="card-body">
                        {!! Form::model( @$informe, ['route' =>[ 'updatePanelID' ],'method' => ( 'PUT'), 'class'=>'form-horizontal','id'=>'form', 'accept-charset' => "UTF-8", 'enctype' => "multipart/form-data" ]) !!}
                        {{Form::hidden('id',$informe->id)}}
                        <div class="col-md-12">
                            <table class="dataTable table-borderless table-condensed table-hover" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 10px">
                                                {!! $informe->informe!!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row pb-15">
                                                <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
                                                    <h4 style="text-align: center">IMÁGENES</h4><hr>
                                                    <div class="top-content">
                                                        <div class="container-fluid">
                                                            <div id="carouselExampleControls{{$informe->id}}" class="carousel slide" data-ride="carousel">
                                                                <div class="carousel-inner row w-100 mx-auto">
                                                                    @foreach($informe->imagenes() as $imagen)
                                                                    <div class="carousel-item col-12 col-sm-4 col-md-4 col-lg-4 {{($loop->first) ? 'active' : ''}}">
                                                                        <a href="{{asset('informes')}}/{{$imagen->anexo}}" target="_blank" class="btn btn-sm btn-secondary">
                                                                            <img class="img-fluid mx-auto d-block" src="{{asset('informes')}}/{{$imagen->anexo}}" style="width:100%;">
                                                                        </a>
                                                                    </div>
                                                                    @endforeach   
                                                                </div>
                                                                <a class="carousel-control-prev" href="#carouselExampleControls{{$informe->id}}" role="button" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carouselExampleControls{{$informe->id}}" role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pb-15">
                                                <div class="col-md-8 mr-auto ml-auto" style="padding-top: 10px">
                                                    <h4 style="text-align: center">ANEXOS</h4><hr>
                                                    <div class="row">
                                                        @foreach($informe->documentos() as $documento)
                                                        <div class="col-md-2">
                                                            <a href="{{asset('informes')}}/{{$documento->anexo}}" target="_blank" class="btn btn-sm">ANEXO {{$loop->index+1}}</a>
                                                        </div>
                                                        @endforeach   
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Comentarios:
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group" style="margin-bottom: 10px">
                                                {!! Form::textArea('observaciones',null,['class'=>'form-control','rows'=>'2']) !!}<i class="form-group__bar"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                       
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <br>
                                <button type="submit" class="btn btn-success"><i class="fa fa-send-o mr-2"></i>Enviar</button>
                            </div>
                        </div>
                        {!! Form::close() !!}                      
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <br>
        <a class="btn btn-secondary" href="{{url('/panel')}}"><i class="fa fa-arrow-circle-left mr-2"></i>Regresar</a>
    </div>
</div>
<script>
$('#carousel-example').on('slide.bs.carousel', function (e) {
    /*
        CC 2.0 License Iatek LLC 2018 - Attribution required
    */
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 3;
    var totalItems = $('.carousel-item').length;
 
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});
    </script>
@endsection
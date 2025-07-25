@extends('layouts.app', ['activePage' => @$sActivePage ])
@section('content')


<style>
.container-cubo {
  width: 150px;
  height: 150px;
  margin: 50px auto;
  position: relative;
  perspective: 400px;
}

#cube {
  width: 100%;
  height: 100%;
  position: absolute;
  transform-style: preserve-3d;
  transition: transform 1s;
}

#cube figure {
  position: absolute;
  width: 100%;
  height: 100%;
  margin: 0;
  border: 2px solid black;
}

#cube .back {
  background: #2684c1d1;
  transform: rotateX(0deg) translateZ(-75px);
}

#cube .left {
  background: #263946d1;
  transform: rotateY(90deg) translateZ(-75px);
}

#cube .bottom {
  background: #02121dd1;
  transform: rotateX(90deg) translateZ(-75px);
}

#cube .front {
  background: #072d46d1;
  transform: rotateX(0deg) translateZ(75px);
}

#cube .right {
  background: #6a7c88d1;
  transform: rotateY(90deg) translateZ(75px);
}

#cube .top {
  background: #6d8fa0d1;
  transform: rotateX(90deg) translateZ(75px);
}

.botones {
  width: 30px;
  height: 30px;
  margin: 0 auto;
  position: relative;
 }

.boton {
  /*estructura*/
  width: 30px;
  height: 30px;
  background-color: black;
  border-radius: 50%;
  position: absolute;
  /*texto*/
  color: white;
  font-weight: bold;
  text-align: center;
  line-height: 30px;
  cursor: pointer;
  user-select: none;
}

#abajo {
  top: 35px;
}

#izquierda {
  top: 35px;
  left: -120px;
}

#derecha {
  top: 35px;
  left: 120px;
}
</style>

<section class="container-cubo">
  <div id="cube">
    <figure class="back"></figure>
    <figure class="left"></figure>
    <figure class="bottom"></figure>
    <figure class="front"><img style="width:50px; height:auto;" src="/material/img/logo_escudo.png"></figure>
    <figure class="right"></figure>
    <figure class="top"></figure>
  </div>
  <section class="botones" style="margin-bottom:35px">
    <!--div class="boton" id="arriba">▲</div-->
    <!--div class="boton" id="abajo">▼</div-->
    <div class="boton" id="izquierda">◄</div>
    <div class="boton" id="derecha">►</div>
  </section>
</section>
<div id="info-1" class="info-cubo">
  <h3>Información 1</h3>
  <p>
    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
  </p>
</div>
<div id="info-2" class="info-cubo">
  <h3>Información 2</h3>
  <p>
    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
  </p>
</div>
<div id="info-3" class="info-cubo">
  <h3>Información 3</h3>
  <p>
    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
  </p>
</div>
<div id="info-4" class="info-cubo">
  <h3>Información 4</h3>
  <p>
    Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
  </p>
</div>

<script>
var angX = 0;
var angY = 0;
var info_view = 1;
$(".info-cubo").hide();
$("#info-"+info_view).show();


$('.boton').on('click', function() {
  switch ($(this).attr("id")) {
    case "arriba":
      angX = angX + 90;
      break;
    case "abajo":
      angX = angX - 90;
      break;
    case "derecha":
      angY = angY + 90;
      info_view = ( (info_view + 1) > 4 ? 1 : info_view + 1);
      $(".info-cubo").slideUp();
      $("#info-"+info_view).slideDown();
      break;
    case "izquierda":
      angY = angY - 90;
      info_view = ( (info_view - 1) < 1 ? 4 : info_view - 1);
      $(".info-cubo").slideUp();
      $("#info-"+info_view).slideDown();
      break;
  }
  $('#cube').attr('style', 'transform: rotateX(' + angX + 'deg) rotateY(' + angY + 'deg);')
});
</script>
@endsection

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand">{{ @$titlePage }} <small>{{ @$descriptionPage }}</small></a>
    </div>

    <div class="">
      <small>
        @if( @$aBreadCrumb != null )
        <a href="{{url('home')}}" class="color-fbm-blue">Inicio</a>
        @foreach($aBreadCrumb as $key => $aBread)
        @if( $aBread['link'] == 'active' )
        / <a> {{$aBread['label']}} </a>
        @else
        / <a href="{{$aBread['link']}}" class="color-fbm-blue"> {{$aBread['label']}} </a>
        @endif
        @endforeach
        @endif
      </small>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
      </ul>
    </div>
  </div>
</nav>

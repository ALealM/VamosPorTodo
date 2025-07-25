@extends('layouts.app', ['activePage' => 'contratos', 'mainPage' => 'Contratos'])
@section('title', 'Main page')
@section('content')
<style>
.nav-pills .nav-link.active {
    background-color: #e8ebf5;
}

thead {
    text-align: center;
    background-color: #fff;
}
</style>



<div class="container">
  <div class="row">
    <div class="col-md-12" style="overflow:scroll;">
      @include('contratos.table')
    </div>

  </div>
</div>



@endsection

@extends('layouts.app', ['activePage' => 'convenios', 'mainPage' => 'Convenios'])
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
      @include('convenios.table')
    </div>

  </div>
</div>



@endsection

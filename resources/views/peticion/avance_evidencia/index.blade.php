@extends('layouts.app')
@section('title', 'Main page')
@section('content')

  <div class="mb-2 mt-2">
    <a href="{{url('peticion/avance_evidencia/create')}}" class="btn btn-success"><i class="fa fa-plus-square mr-2"></i>Nuevo Avance</a>
  </div>

  
    @include('peticion.avance_evidencia.table')
  

    <script>
const data = {
  labels: new Array(12).fill('Label'),
  datasets: [
    {
      data: [0, 15, 10, 25, 30, 15, 40, 50, 80, 60, 55, 65],
    },
  ],
};

const options = {
  scales: {
    y: {
      display: false,
    },
    x: {
      display: false,
    },
  },
  elements: {
    line: {
      borderWidth: 2,
      borderColor: '#D2DDEC',
    },
    point: {
      hoverRadius: 0,
    },
  },
  plugins: {
    tooltip: {
      external: () => false,
    },
  },
};

</script>
@endsection

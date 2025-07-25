@extends('layouts.app')
@section('title', 'Main page')
@section('content')

<div class="box box-default">
    
    <div class="box-header with-border">
        <h3 class="box-title">Actividades en colaboración</h3>
    </div>

    <div class="box-body">        
            {!! Form::model($colaborador,['class'=>'form-horizontal','id'=>'form']) !!}
            {{ csrf_field() }}

        @include('peticion.colaborador.showFields')

        </form>
    </div>
</div>

@endsection

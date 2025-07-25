@extends('layouts.app')
@section('title', 'Main page')
@section('content')

<div class="box box-default">
    
    <div class="box-header with-border">
        <h3 class="box-title">Actividades</h3>
    </div>

    <div class="box-body">        
            {!! Form::model($responsable,['class'=>'form-horizontal','id'=>'form']) !!}
            {{ csrf_field() }}

        @include('peticion.responsable.showFields')

        </form>
    </div>
</div>

@endsection

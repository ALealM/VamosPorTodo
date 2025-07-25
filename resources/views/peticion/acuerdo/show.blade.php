@extends('layouts.app')
@section('title', 'Main page')
@section('content')

<div class="box box-default">
    
    <div class="box-header with-border">
        <h3 class="box-title">Acuerdos</h3>
    </div>

    <div class="box-body">        
            {!! Form::model($acuerdo,['class'=>'form-horizontal','id'=>'form']) !!}
            {{ csrf_field() }}

        @include('peticion.acuerdo.showFields')

        </form>
    </div>
</div>

@endsection

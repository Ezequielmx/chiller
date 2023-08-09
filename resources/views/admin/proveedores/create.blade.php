@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content')
    <div class="pt-2"></div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-fw fa-truck" aria-hidden="true"></i>&nbsp;Nuevo Proveedor</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['route'=>'admin.proveedores.store']) !!}

                @include('admin.proveedores.partials.form')


                <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary mt-2 ml-2 float-right">Cancelar</a>
                {!! Form::submit('Crear Proveedor', ['class'=>'btn btn-primary mt-2  float-right']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
@extends('adminlte::page')

@section('title', 'Empresas')

@section('content')
    @livewire('admin.empresas.index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
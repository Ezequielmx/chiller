@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content')
@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif
@livewire('admin.ordenes.form', ['id' => $id])
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
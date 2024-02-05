@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content')
@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif
@livewire('admin.ordenes.form')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('createOrd', orden_id =>{
            Swal.fire({
                title: '¿Está seguro que desea crear la Orden y enviarla al proveedor?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, crearla!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('guardar', true);
                    Swal.fire(
                        'Creada!',
                        'La orden fue creada y enviada al proveedor.',
                        'success'
                    )
                }
            })
    });
</script>
@stop
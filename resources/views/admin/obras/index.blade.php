@extends('adminlte::page')

@section('title', 'Obras')

@section('content')
@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif
@livewire('admin.obras.index')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('deleteOb', cotizacion_id =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar esta Obra?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteObra', cotizacion_id);
                    Swal.fire(
                    'Eliminada!',
                    'La ohbra ha sido eliminado.',
                    'success'
                    )
                }
            })  
        });
    
</script>
@stop
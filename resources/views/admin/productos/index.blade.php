@extends('adminlte::page')

@section('title', 'Productos')

@section('content')
@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif
@livewire('admin.productos.index')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
    Livewire.on('deleteProd', cotizacion_id =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar este Producto?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteProducto', cotizacion_id);
                    Swal.fire(
                    'Eliminado!',
                    'El Producto ha sido eliminado.',
                    'success'
                    )
                }
            })  
        });
    
</script>
@stop
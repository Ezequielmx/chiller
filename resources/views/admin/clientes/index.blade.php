@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif
@livewire('admin.clientes.index')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('deleteCli', cliente_id =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar este Cliente?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteCliente', cliente_id);
                    Swal.fire(
                    'Eliminao!',
                    'El Cliente ha sido eliminado.',
                    'success'
                    )
                }
            })  
        });
    
</script>
<script>
    $(document).ready(function(){
        $(':checkbox[readonly=readonly]').click(function(){
            return false;        
            });
    });
</script>
@stop
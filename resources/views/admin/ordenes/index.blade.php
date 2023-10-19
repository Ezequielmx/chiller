@extends('adminlte::page')

@section('title', 'Ordenes')

@section('content')
@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif
@livewire('admin.ordenes.index')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('deleteOrd', orden_id =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar esta Orden?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteOrden', orden_id);
                    Swal.fire(
                    'Eliminada!',
                    'La orden ha sido eliminada.',
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
@extends('adminlte::page')

@section('title', 'Rubros')

@section('content')
    @livewire('admin.rubros.index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('deleteRub', rubro_id =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar este Rubro?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteRubro', rubro_id);
                    Swal.fire(
                    'Eliminado!',
                    'El Rubro ha sido eliminado.',
                    'success'
                    )
                }
            })  
        });
    
</script>
@stop
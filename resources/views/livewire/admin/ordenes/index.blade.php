<div>
    <div class="card">
        @if ($ordenes->count())
        <div class="card-header">
            <div class="card-title">
                <h3>Ódenes</h3>
            </div>
            
            <div class="card-tools">
                <!--button for nueva Orden-->
                <a class="btn btn-success btn-sm" href="{{ route('admin.ordenes.create') }}">Nueva Orden</a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Proveedor</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordenes as $orden)
                        <tr>
                            <td>{{ $orden->id }}</td>
                            <td>{{ $orden->proveedor->razon_social}}</td>
                            <td>{{ $orden->fecha }}</td>
                            <td>{{ $orden->estado->nombre }}</td>
                            <td width="10px" style="text-wrap: nowrap;">
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.ordenes.edit', $orden->id) }}">Editar</a>
                                <a class="btn btn-danger btn-sm"
                                    wire:click="$emit('deleteOrd',{{ $orden->id }})">Eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $ordenes->links() }}
        </div>
        @else
        <div class="card-body">
            <strong>No hay registros...</strong>
        </div>
        @endif
    </div>
</div>
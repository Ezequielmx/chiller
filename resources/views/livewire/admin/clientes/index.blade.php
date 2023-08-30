<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-user-tie" aria-hidden="true"></i>&nbsp;Clientes</h3>
                </div>
                <div class="col">
                    <a href="{{ route('admin.clientes.create') }}" class="btn btn-success float-right"><i
                            class="fa fa-plus"></i> Nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th style="width: 10px"></th>
                        <th>Id</th>
                        <th>Razón Social</th>
                        <th>CUIT</th>
                        <th>Contacto</th>
                        <th>Activo</th>
                        <th style="width: 10px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr {{ $cliente->activo? '' :'style=color:darkgray;' }}>
                        <td data-toggle="collapse" data-target={{'#prov' . $cliente->id }} class="accordion-toggle">
                            <button class="btn btn-default btn-xs"><i class="fas fa-eye"></i></button>
                        </td>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->razon_social }}</td>
                        <td>{{ $cliente->cuit }}</td>
                        <td>{{ $cliente->contacto }}</td>
                        <td>
                            <input type="checkbox" {{ $cliente->activo ? 'checked' : '' }} readonly='readonly'>
                        </td>
                        <td style="white-space:nowrap">
                            <a class="btn btn-primary btn-sm mr-1"
                                href="{{ route('admin.clientes.edit', $cliente->id) }}">
                                <i class="fa fa-edit"></i></button>
                            </a>

                            <button wire:click="$emit('deleteCli',{{ $cliente->id }})"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="12" class="hiddenRow">
                            <div class="accordian-body collapse" id={{'prov' . $cliente->id }}>
                                <table class="table table-sm">
                                    <thead>
                                        <tr class="table-info">
                                            <th></th>
                                            <th>Dirección</th>
                                            <th>Teléfono</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>{{ $cliente->direccion }}</td>
                                            <td>{{ $cliente->telefono }}</td>
                                            <td>{{ $cliente->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
        <div class="card-footer">
            {{ $clientes->links() }}
        </div>
    </div>
</div>
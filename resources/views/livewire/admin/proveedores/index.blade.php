<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-fw fa-truck" aria-hidden="true"></i>&nbsp;Proveedores</h3>
                </div>
                <div class="col">
                    <a href="{{ route('admin.proveedores.create') }}" class="btn btn-success float-right"><i
                            class="fa fa-plus"></i> Nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th style="width: 10px"></th>
                        <th>Cód</th>
                        <th>Razón Social</th>
                        <th>CUIT</th>
                        <th>Contacto</th>
                        <th>Activo</th>
                        <th style="width: 10px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                    <tr {{ $proveedor->activo? '' :'style=color:darkgray;' }}>
                        <td data-toggle="collapse" data-target={{'#prov' . $proveedor->id }} class="accordion-toggle">
                            <button class="btn btn-default btn-xs"><i class="fas fa-eye"></i></button>
                        </td>
                        <td>{{ $proveedor->codigo }}</td>
                        <td>{{ $proveedor->razon_social }}</td>
                        <td>{{ $proveedor->cuit }}</td>
                        <td>{{ $proveedor->contacto }}</td>
                        <td>
                            <input type="checkbox" {{ $proveedor->activo ? 'checked' : '' }} readonly='readonly'>
                        </td>
                        <td style="white-space:nowrap">
                            <a class="btn btn-primary btn-sm mr-1"
                                href="{{ route('admin.proveedores.edit', $proveedor->id) }}">
                                <i class="fa fa-edit"></i></button>
                            </a>

                            <button wire:click="$emit('deleteProv',{{ $proveedor->id }})"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="12" class="hiddenRow">
                            <div class="accordian-body collapse" id={{'prov' . $proveedor->id }}>
                                <table class="table table-sm">
                                    <thead>
                                        <tr class="table-info">
                                            <th>Dirección</th>
                                            <th>Teléfono</th>
                                            <th>Email</th>
                                            <th>Web</th>
                                            <th>Forma Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $proveedor->direccion }}</td>
                                            <td>{{ $proveedor->telefono }}</td>
                                            <td>{{ $proveedor->email }}</td>
                                            <td>{{ $proveedor->web }}</td>
                                            <td>{{ $proveedor->formaPago->descripcion }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
</div>
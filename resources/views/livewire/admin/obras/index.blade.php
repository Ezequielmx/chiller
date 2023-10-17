<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-paint-roller " aria-hidden="true"></i>&nbsp;Obras</h3>
                </div>
                <div class="col">
                    <a href="{{ route('admin.obras.create') }}" class="btn btn-success float-right"><i
                            class="fa fa-plus"></i> Nueva</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <!--select for rubros-->
                        <label for="rubro_id">Filtrar por Cliente</label>
                        <select class="form-control" wire:model="cliente_id">
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                            @endforeach
                        </select> 
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <!--input for search-->
                        <label for="search">Buscar por nombre</label>
                        <input type="text" class="form-control" placeholder="Buscar" wire:model="search">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <!--buton clean filters with eraser icon-->
                        <button wire:click="borrarFiltros" class="btn btn-outline-secondary btnspct float-right"><i
                                class="fas fa-eraser"></i>Borrar Filtros</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th style="width: 10px"></th>
                        <th style="width: 10px">Id</th>
                        <th>Cliente</th>
                        <th>Nombre</th>
                        <th>Presupuesto</th>
                        <th>Activa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obras as $obra)
                    <tr {{ $obra->activo? '' : 'style=color:darkgray' }}>
                        <td data-toggle="collapse" data-target={{'#obra' . $obra->id }} class="accordion-toggle">
                            <button class="btn btn-default btn-xs"><i class="fas fa-eye"></i></button>
                        </td>
                        <td>
                            {{ $obra->id }}
                        </td>
                        <td>
                            {{ $obra->cliente->razon_social }}
                        </td>
                        <td>
                            {{ $obra->nombre }}
                        </td>
                        <td>
                            {{ $obra->presupuesto }}
                        </td>
                        <td style="width: 10px">
                            @if ($obra->activo)
                            <span class="badge badge-success">Si</span>
                            @else
                            <span class="badge badge-secondary">No</span>
                            @endif
                        </td>
                        <td style="white-space: nowrap; width: 10px">
                            <a href="{{ route('admin.obras.edit', $obra->id) }}"
                                class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i></a>
                            <button wire:click="$emit('deleteOb',{{ $obra->id }})" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="12" class="hiddenRow">
                            <div class="accordian-body collapse" id={{'obra' . $obra->id }}>
                                <table class="table table-sm">
                                    <thead>
                                        <tr class="table-info">
                                            <th></th>
                                            <th>Dirección</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>{{ $obra->direccion }}</td>
                                            <td>{{ $obra->detalle }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $obras->links() }}
        </div>
    </div>

</div>
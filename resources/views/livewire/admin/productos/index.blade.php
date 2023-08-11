<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-fw fa-boxes" aria-hidden="true"></i>&nbsp;Productos</h3>
                </div>
                <div class="col">
                    <a href="{{ route('admin.productos.create') }}" class="btn btn-success float-right"><i
                            class="fa fa-plus"></i> Nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <!--select for rubros-->
                        <label for="rubro_id">Rubro</label>
                        <select class="form-control" wire:model="rubro_id">
                            <option value="">Seleccione un rubro</option>
                            @foreach ($rubros as $rubro)
                            <option value="{{ $rubro->id }}">{{ $rubro->nombre }}</option>
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
                        <th>Código</th>
                        <th>Rubro</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Detalle</th>
                        <th>Activo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <tr {{ $producto->activo? '' : 'style=color:darkgray' }}>
                        <td style="width: 10%">
                            {{ $producto->codigo }}
                        </td>
                        <td style="width: 20%">
                            {{ $producto->rubro->nombre }}
                        </td>
                        <td style="width: 20%">
                            {{ $producto->nombre }}
                        </td>
                        <td style="width: 20%">
                            {{ $producto->marca }}
                        </td>
                        <td style="width: 20%">
                            {{ $producto->detalle }}
                        </td>
                        <td style="width: 10%">
                            @if ($producto->activo)
                            <span class="badge badge-success">Si</span>
                            @else
                            <span class="badge badge-secondary">No</span>
                            @endif
                        </td>
                        <td style="white-space: nowrap; width: 10px">
                            <a href="{{ route('admin.productos.edit', $producto->id) }}"
                                class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i></a>
                            <button wire:click="$emit('deleteProd',{{ $producto->id }})" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $productos->links() }}
        </div>
    </div>

</div>
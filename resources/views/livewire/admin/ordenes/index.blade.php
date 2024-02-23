<div class="pt-2">
    <div class="card">

        <div class="card-header">
            <div class="card-title">
                <h3>
                    <i class="fas fa-fw fa-file-invoice-dollar "></i>
                    Órdenes
                </h3>
            </div>

            <div class="card-tools">
                @can('orden.create')
                  <!--button for nueva Orden-->
                <a class="btn btn-success" href="{{ route('admin.ordenes.create') }}"><i class="fa fa-plus"></i> Nueva
                    Orden</a>  
                @endcan
                
            </div>
        </div>
        <div class="card-body">
            <div class="row" style="align-items: center;">
                <div class="col-12 col-md-2">
                    <!--proveedor select-->
                    <div class="form-group">
                        <label for="proveedor_id">Proveedor</label>
                        <select wire:model="proveedor_id" class="form-control">
                            <option value="">Todos</option>
                            @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-9 col-md-2">
                    <!--estado select-->
                    <div class="form-group">
                        <label for="estado_id">Estado</label>
                        <select wire:model="estado_id" class="form-control">
                            <option value="">Todos</option>
                            @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3 col-md-1 text-center">
                    <!--checkbox finalizadas-->
                    <div class="form-group">
                        <label for="finalizadas">Cerradas</label>
                        <input wire:model="finalizadas" type="checkbox" class="form-control">
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <!--aprobadas select-->
                    <div class="form-group">
                        <label for="aprobadas">Autorización</label>
                        <select wire:model="aprobadas" class="form-control">
                            <option value=-1>Todas</option>
                            <option value=0>Sin autorizar</option>
                            <option value=1>Autorizadas</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <!--buton clean filters with eraser icon-->
                        <button wire:click="borrarFiltros" class="btn btn-outline-secondary mt-4"><i
                                class="fas fa-eraser"></i>Borrar Filtros</button>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <div class="card">
        @if ($ordenes->count())
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Realizada por</th>
                        <th>Retira</th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>Presup</th>
                        <th>Estado</th>
                        <th>Autorizada</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordenes as $orden)
                    <tr class="{{ strtolower($orden->estado->nombre) }}">
                        <td>{{ $orden->nro }}</td>
                        <td>{{ $orden->user->name }}</td>
                        <td>{{ $orden->user_ret->name }}</td>
                        <td>{{ $orden->proveedor->razon_social}}</td>
                        <td>{{ date('d-m-Y',strtotime($orden->fecha)) }}</td>
                        <td>{{ $orden->obra->presupuesto }}</td>
                        <td>{{ $orden->estado->nombre }}</td>
                        <td style="width: 10%">
                            @if ($orden->autorizado)
                            <span class="badge badge-success">Si</span>
                            @else
                            <span class="badge badge-secondary">No</span>
                            @endif
                        </td>
                        <td width="10px" style="text-wrap: nowrap;">
                            @if ($orden->estado_id < 3 or auth()->user()->roles->first()->id > 2)
                                @can('orden.edit')
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.ordenes.edit', $orden->id) }}">Editar</a>  
                                @endcan
                                
                                @can('orden.delete')
                                <a class="btn btn-danger btn-sm"
                                    wire:click="$emit('deleteOrd',{{ $orden->id }})">Eliminar</a> 
                                @endcan
                            @endif
                            <!-- a href print button with pdf icon-->
                            <a href="{{ route('admin.ordenes.print', $orden) }}" target="_blank"
                                class="btn btn-secondary btn-sm"><i class="fa fa-file-pdf"></i></a>

                            @can('orden.autorize')
                                <button class="btn btn-sm {{ !$orden->autorizado? 'btn-success' : 'btn-danger'}}" wire:click="autorizar({{ $orden->id }})">
                                <i class="fas fa-stamp"></i></button>
                            @endcan
                            
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
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
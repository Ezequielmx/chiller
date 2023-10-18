<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-fw fa-file-invoice-dollar" aria-hidden="true"></i>&nbsp;
                        @if($modeNew)
                        Nueva Órden
                        @else
                        Editar Orden
                        @endif
                    </h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-sm-2">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" disabled value={{ $modeNew? '' : $orden->id }}>
                    </div>
                </div>
                <div class="col-6 col-sm-2">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control @error('orden.fecha') is-invalid @enderror"
                            placeholder="Fecha" wire:model.defer="orden.fecha">
                        @error('orden.fecha') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="user_id">Creada por</label>
                        <input type="text" class="form-control" disabled value={{ $orden->user->name }}>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <!--select for empresa--->
                        <label for="empresa_id">Empresa solicitante</label>
                        <select class="form-control @error('orden.empresa_id') is-invalid" @enderror name="empresas"
                            id="empresas" wire:model.defer="orden.empresa_id">
                            <option value="">Seleccione una empresa</option>
                            @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                            @endforeach
                        </select>
                        @error('orden.empresa_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <!--select for cliente-->
                        <label for="cliente_id">Cliente</label>
                        <select class="form-control @error('orden.cliente_id') is-invalid" @enderror name="clientes"
                            id="clientes" wire:model="orden.cliente_id">
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                            @endforeach
                        </select>
                        @error('orden.cliente_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <!--select for obra-->
                        <label for="obra_id">Obra</label>
                        <select class="form-control @error('orden.obra_id') is-invalid" @enderror name="obras"
                            id="obras" wire:model.defer="orden.obra_id">
                            <option value="">Seleccione una obra</option>
                            @foreach ($obras as $obra)
                            <option value="{{ $obra->id }}">{{ $obra->nombre }}</option>
                            @endforeach
                        </select>
                        @error('orden.obra_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <!--select for forma pago-->
                        <label for="forma_pago">Forma de pago</label>
                        <select class="form-control @error('orden.forma_pago') is-invalid" @enderror name="forma_pago"
                            id="forma_pago" wire:model.defer="orden.forma_pago">
                            <option value="">Seleccione una forma de pago</option>
                            @foreach ($formasPago as $formaPago)
                            <option value="{{ $formaPago->id }}">{{ $formaPago->descripcion }}</option>
                            @endforeach
                        </select>
                        @error('orden.forma_pago') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-9 col-sm-4">
                    <div class="form-group">
                        <!--select for users_ret_id-->
                        <label for="users_ret_id">A retirar por</label>
                        <select class="form-control @error('orden.users_ret_id') is-invalid" @enderror
                            name="users_ret_id" id="users_ret_id" wire:model.defer="orden.users_ret_id">
                            <option value="">Seleccione un usuario</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('orden.users_ret_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="col-3 col-sm-1">
                    <div class="form-group">
                        <!--checkbox for retirado-->
                        <label for="retirado">Retirado</label>
                        <input type="checkbox" class="form-control @error('orden.retirado') is-invalid" @enderror
                            name="retirado" id="retirado" wire:model.defer="orden.retirado">
                    </div>
                </div>
                <div class="col-sm-1"></div>

                <div class="col-9 col-sm-4">
                    <div class="form-group">
                        <!--input for user_aut_id-->
                        <label for="user_aut">Autorizado por</label>
                        <input type="text" class="form-control" name="user_aut" id="user_aut"
                            value="{{ $orden->user_aut_id? User::find(user_aut_id)->name : '' }}" disabled>
                    </div>
                </div>

                <div class="col-3 col-sm-2">
                    <div class="form-group">
                        @if (!$orden->autorizado)
                        <label>Autorizar</label>
                        <!--boton para autorizar con icono check-->
                        <button type="button" class="form-control btn btn-success" wire:click='autorizar'>
                            <i class="fas fa-check"></i>
                        </button>
                        @else
                        <label>Desaut. </label>
                        <!--boton para cancelar autorizacion con icono x-->
                        <button type="button" class="form-control btn btn-danger" wire:click='cancelarAutorizacion'>
                            <i class="fas fa-times"></i>
                        </button>

                        @endif
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <!--input for factura-->
                        <label for="factura">Factura</label>
                        <input type="text" class="form-control" placeholder="Factura" wire:model.defer="orden.factura">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <!--select for proveedor-->
                        <label for="proveedor_id">Proveedor</label>
                        <select class="form-control @error('orden.proveedor_id') is-invalid" @enderror
                            name="proveedores" id="proveedores" wire:model.defer="orden.proveedor_id">
                            <option value="">Seleccione un proveedor</option>
                            @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                            @endforeach
                        </select>
                        @error('orden.proveedor_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <!--table boostrap for ordenDetalles-->
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Id</th>
                                    <th scope="col" class="text-center">Producto</th>
                                    <th scope="col" class="text-center">Cantidad</th>
                                    <th scope="col" class="text-center">Unidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordenDetalles as $ordenDetalle)
                                <tr>
                                    <td class="text-center">{{ $ordenDetalle->producto_id }}</td>
                                    <td class="text-center">{{ $ordenDetalle->producto->nombre }}</td>
                                    <td class="text-center">{{ $ordenDetalle->cantidad }}</td>
                                    <td class="text-center">{{ $ordenDetalle->unidad->nombre }}</td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            wire:click='eliminar({{ $ordenDetalle->id }})'>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end table boostrap for ordenDetalles-->
            </div>


        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.obras.index') }}" class="btn btn-secondary ml-2 float-right">Cancelar</a>
                    <button wire:click="guardar" class="btn btn-primary float-right">
                        @if($modeNew)
                        Crear Orden
                        @else
                        Guardar
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
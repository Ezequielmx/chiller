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
                        <label for="nro">Nro</label>
                        <input type="text" class="form-control" disabled value={{ $modeNew? '' : $orden->nro }}>
                    </div>
                </div>
                <div class="col-6 col-sm-2">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control @error('orden.fecha') is-invalid @enderror readonly"
                            placeholder="Fecha" wire:model.defer="orden.fecha" {{($orden->estado_id > 1 ||
                        $orden->autorizado == 1)? 'disabled' : ''}}
                        >
                        @error('orden.fecha') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="user_id">Creada por</label>
                        <input type="text" class="form-control" disabled value={{ $orden->user->name }}
                        {{($orden->estado_id > 1 || $orden->autorizado == 1)? 'disabled' : ''}}
                        >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <!--select for empresa--->
                        <label for="empresa_id">Empresa solicitante</label>
                        <select class="form-control @error('orden.empresa_id') is-invalid" @enderror name="empresas"
                            id="empresas" wire:model.defer="orden.empresa_id" {{($orden->estado_id > 1 ||
                            $orden->autorizado == 1)? 'disabled' : ''}}
                            >
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
                        <select class="form-control @error('orden.cliente_id') is-invalid" @enderror name="cliente_id"
                            id="cliente_id" wire:model="orden.cliente_id" {{($orden->estado_id > 1 || $orden->autorizado
                            == 1)? 'disabled' : ''}}
                            >
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
                            id="obras" wire:model.defer="orden.obra_id" {{($orden->estado_id > 1 || $orden->autorizado
                            == 1)? 'disabled' : ''}}
                            >
                            <option value="">Seleccione una obra</option>
                            @foreach ($obras as $obra)
                            <option value="{{ $obra->id }}">{{ $obra->presupuesto . ' - ' . $obra->nombre }}</option>
                            @endforeach
                        </select>
                        @error('orden.obra_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <!--select for forma pago-->
                        <label for="forma_pago_id">Forma de pago</label>
                        <select class="form-control @error('orden.forma_pago_id') is-invalid" @enderror
                            name="forma_pago_id" id="forma_pago_id" wire:model.defer="orden.forma_pago_id"
                            {{($orden->estado_id > 1 || $orden->autorizado == 1)? 'disabled' : ''}}
                            >
                            <option value="">Seleccione una forma de pago</option>
                            @foreach ($formasPago as $formaPago)
                            <option value="{{ $formaPago->id }}">{{ $formaPago->descripcion }}</option>
                            @endforeach
                        </select>
                        @error('orden.forma_pago_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <!--select for users_solic_id-->
                        <label for="users_solic_id">Autorizada por</label>
                        <select class="form-control" id="user_solic_id" wire:model.defer="orden.user_solic_id"
                            {{($orden->estado_id > 1 || $orden->autorizado == 1)? 'disabled' : ''}}
                            >
                            <option value="">Seleccione un usuario</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('orden.user_solic_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="col-9 col-sm-4">
                    <div class="form-group">
                        <label for="retira">A Retirar Por</label>
                        <input type="text" class="form-control @error('orden.retira') is-invalid" @enderror
                            name="retira" id="retira" wire:model.defer="orden.retira" {{($orden->estado_id > 1 ||
                        $orden->autorizado == 1)? 'disabled' : ''}}
                        >
                        @error('orden.retira') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                @if(!$modeNew)
                <div class="col-3 col-sm-1">
                    <div class="form-group">
                        <!--checkbox for retirado-->
                        <label for="retirado">Retirado</label>
                        <input type="checkbox" class="form-control @error('orden.retirado') is-invalid" @enderror
                            name="retirado" id="retirado" wire:model.defer="orden.retirado">
                    </div>
                </div>

                <div class="col-sm-1"></div>
                @endif
            </div>

            <div class="row">
                @if(!$modeNew)
                <div class="col-12 col-sm-5">
                    <div class="row">
                        <div class="col-9 col-sm-10">
                            <div class="form-group">
                                <!--input for user_aut_id-->
                                <label for="user_aut">V.B</label>
                                <input type="text" class="form-control" name="user_aut" id="user_aut"
                                    value="{{ $orden->user_aut_id? $orden->user_aut->name : '' }}" disabled>
                            </div>
                        </div>

                        <div class="col-3 col-sm-2">
                            @can('orden.autorize')
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
                                <button type="button" class="form-control btn btn-danger"
                                    wire:click='cancelarAutorizacion'>
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif
                            </div>
                            @endcan
                        </div>
                    </div>

                    <div class="row">
                        @can('orden.factura')
                        <div class="col-sm-12">
                            <div class="form-group">
                                <!--input for factura-->
                                <label for="factura">Factura</label>
                                <input type="text" class="form-control" placeholder="Factura"
                                    wire:model.defer="orden.factura">
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
                @endif
                <div class="col">
                    <div class="form-group">
                        <!--input for observaciones multiline 3-->
                        <label for="factura">Observaciones</label>
                        <textarea class="form-control" rows="4" wire:model.defer="orden.observaciones"></textarea>
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
                            name="proveedores" id="proveedores" wire:model.defer="orden.proveedor_id"
                            {{($orden->estado_id > 1 || $orden->autorizado == 1)? 'disabled' : ''}}
                            >
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
                                    <th scope="col" class="text-center">Cant</th>
                                    <th scope="col" class="text-center" style="min-width: 125px;">Unidad</th>
                                    <th scope="col" class="text-center" style="min-width: 125px;">Observ</th>
                                    <th scope="col" class="text-right" style="min-width: 125px;">Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($modeNew)
                                @foreach ($ordenDetalles as $index => $ordenDetalle)
                                <tr>
                                    <td class="text-center">{{ $ordenDetalle['producto_id'] }}</td>
                                    <td class="text-center">{{ $ordenDetalle['producto']}}</td>
                                    <td class="text-center" style="max-width: 100px">
                                        <input type="number" wire:model="ordenDetalles.{{ $index }}.cantidad"
                                            class="form-control" min="1">
                                    </td>
                                    <td class="text-center">
                                        <!--select for unidad-->
                                        <select class="form-control" name="unidades" id="unidades"
                                            wire:model="ordenDetalles.{{ $index }}.unidad_id">
                                            @foreach ($unidades as $unidad)
                                            <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('ordenDetalles.{{ $index }}.unidad_id') <small class="text-danger">{{
                                            $message }}</small>@enderror

                                    </td>

                                    <td>
                                        <input type="text" wire:model="ordenDetalles.{{ $index }}.observaciones"
                                            class="form-control">
                                    </td>

                                    <td class="text-right">
                                        <input type="number" step="any" wire:model="ordenDetalles.{{ $index }}.precio"
                                            class="form-control text-right">
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            wire:click='removeProduct({{$index}})'>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-right">Total</td>
                                    <td class="text-right">
                                        {{ number_format(collect($ordenDetalles)->sum('precio'), 2, ',', '.') }}
                                    </td>
                                </tr>
                                @else
                                @foreach ($ordenDetalles as $ordenDetalle)
                                <tr>
                                    <td class="text-center">{{ $ordenDetalle->producto_id }}</td>
                                    <td class="text-center">{{ $ordenDetalle->producto->nombre }}</td>
                                    <td class="text-center"  style="max-width: 100px">
                                        <input type="number"
                                            wire:change="updateCantidad({{ $ordenDetalle->id }}, $event.target.value)"
                                            class="form-control" min="1" value="{{ $ordenDetalle->cantidad }}"
                                            {{($orden->estado_id > 1 || $orden->autorizado == 1)? 'disabled' : ''}}
                                            >
                                    </td>
                                    <td class="text-center" style="width: 50px">
                                        <!--select for unidad-->
                                        <select class="form-control" name="unidades" id="unidades"
                                            wire:change='updateUnidad({{ $ordenDetalle->id }}, $event.target.value)'
                                            {{($orden->estado_id > 1 || $orden->autorizado == 1)? 'disabled' : ''}}
                                            >
                                            @foreach ($unidades as $unidad)
                                            <option value="{{ $unidad->id }}" {{ $unidad->id ==
                                                $ordenDetalle->unidad_id?
                                                'selected' : '' }}>{{ $unidad->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="text-center" >
                                        <input type="text" wire:change='updateObservaciones({{ $ordenDetalle->id }},
                                            $event.target.value)' class="form-control"
                                            value="{{ $ordenDetalle->observaciones }}"
                                            {{($orden->estado_id > 1 || $orden->autorizado == 1)? 'disabled' : ''}}
                                            >
                                    </td>

                                    <td  style="width: 50px">
                                        <input type="number" step="any" value="{{ $ordenDetalle->precio }}"
                                            class="form-control text-right"
                                            wire:change='updatePrecio({{ $ordenDetalle->id }}, $event.target.value)'
                                            {{($orden->estado_id > 1 || $orden->autorizado == 1)? 'disabled' : ''}}
                                            >
                                    </td>

                                    <td class="text-center" >
                                        @if($orden->estado_id == 1 && $orden->autorizado == 0)
                                        <button type="button" class="btn btn-danger btn-sm"
                                            wire:click='removeProductG({{$ordenDetalle->id}})'>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-right">Total</td>
                                    <td class="text-right">
                                        {{ number_format($ordenDetalles->sum('precio'), 2, ',', '.') }}
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--button for addProduct-->
            <div class="row" style="justify-content: flex-end;">
                @if($orden->estado_id == 1 && $orden->autorizado == 0)
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addProductModal">
                    Agregar Productos
                </button>
                @endif
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col">

                    <a href="{{ route('admin.ordenes.index') }}" class="btn btn-secondary">Cancelar</a>

                </div>
                <div class="col">
                    @if($orden->estado_id==1)
                    <div class="row" style="justify-content: flex-end;">
                        <button wire:click="guardar" class="btn btn-primary">
                            @if($modeNew)
                            Crear Borrador
                            @else
                            Guardar Borrador
                            @endif
                        </button>

                        <button wire:click="$emit('createOrd')" class="btn btn-success ml-2">
                            Crear Orden y enviar a Proveedor
                        </button>
                    </div>
                    @else
                    <div class="row" style="justify-content: flex-end;">
                        <button wire:click="guardar" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                    @endif
                </div>



            </div>
        </div>
    </div>


    <!-- popup for find and select products-->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="max-height: 90vh; overflow: scroll;">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="productModalLabel">Productos</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-8">
                            <label for="searchTerm">Buscar</label>
                            <textarea name="Text1" rows="2" wire:model="searchTerm" class="form-control"
                                placeholder="Buscar..."></textarea>
                        </div>
                        <div class="col-10 col-sm-3">
                            <!--select for rubro-->
                            <label for="rubro_id">Rubro</label>
                            <select class="form-control @error('rubroSel') is-invalid" @enderror name="rubros"
                                id="rubros" wire:model="rubroSel">
                                <option value="">Todos los rubros</option>
                                @foreach ($rubros as $rubro)
                                <option value="{{ $rubro->id }}">{{ $rubro->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 col-sm-1">
                            @if($products->count() == 0 && $rubroSel)
                            <td>
                                <label for="rubro_id">Nuevo</label>
                                <button class="btn btn-success btn-sm" wire:click="insertProduct()"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </td>
                            @endif
                        </div>
                    </div>

                    <table class="table table-bordered table-sm mt-3">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Rubro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->nombre }}</td>
                                <td>{{ $product->rubro->nombre }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm"
                                        wire:click="addProduct({{ $product->id }})"><i class="fas fa-plus"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
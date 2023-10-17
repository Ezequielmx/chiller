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
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" disabled value={{ $modeNew? '' : $orden->id }}>
                    </div>
                </div>
                <div class="col-sm-2">
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
                        <!--select for proveedor-->
                        <label for="proveedor_id">Proveedor</label>
                        <select class="form-control @error('orden.proveedor_id') is-invalid" @enderror name="proveedores"
                            id="proveedores" wire:model.defer="orden.proveedor_id">
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
                
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.obras.index') }}"
                        class="btn btn-secondary ml-2 float-right">Cancelar</a>
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
<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-paint-roller" aria-hidden="true"></i>&nbsp;
                        @if($modeNew)
                        Nueva Obra
                        @else
                        Editar Obra
                        @endif
                    </h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-1">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" disabled value={{ $modeNew? '' : $obra->id }}>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="form-group">
                        <!--select for clientes-->
                        <label for="cliente_id">Cliente</label>
                        <select class="form-control @error('obra.cliente_id') is-invalid" @enderror name="clientes"
                            id="clientes" wire:model.defer="obra.cliente_id">
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                            @endforeach
                        </select>
                        @error('obra.cliente_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="col-sm-1">
                    <div class="form-group">
                        <!--checkbox for activo-->
                        <label for="activo">Activa</label>
                        <input type="checkbox" wire:model.defer="activo" class="form-control" style="max-width: 30px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <!--input for nombre-->
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control @error('obra.nombre') is-invalid @enderror"
                            placeholder="Nombre" wire:model.defer="obra.nombre">
                        @error('obra.nombre') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <!--input for presupuesto-->
                        <label for="presupuesto">Presupuesto</label>
                        <input type="text" class="form-control @error('obra.presupuesto') is-invalid @enderror"
                            placeholder="Presupuesto" wire:model.defer="obra.presupuesto">
                        @error('obra.presupuesto') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                        <!--input for direccion-->
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control @error('obra.direccion') is-invalid @enderror"
                            placeholder="Dirección" wire:model.defer="obra.direccion">
                        @error('obra.direccion') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                        <!--textarea for detalle-->
                        <label for="detalle">Detalle</label>
                        <textarea class="form-control" name="detalle" wire:model.defer="obra.detalle"
                            rows="3"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.obras.index') }}" class="btn btn-secondary ml-2 float-right">Cancelar
                    </a>
                    <button wire:click="guardar" class="btn btn-primary float-right">
                        @if($modeNew)
                        Crear Obra
                        @else
                        Guardar
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
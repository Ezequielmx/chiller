<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-fw fa-boxes" aria-hidden="true"></i>&nbsp;
                        @if($modeNew)
                        Nuevo Producto
                        @else
                        Editar Producto
                        @endif
                    </h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <!--input for codigo-->
                        <label for="codigo">Código</label>
                        <input type="text" class="form-control @error('producto.codigo') is-invalid @enderror"
                            placeholder="Código" wire:model.defer="producto.codigo">
                        @error('producto.codigo') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <!--select for rubros-->
                        <label for="rubro_id">Rubro</label>
                        <select class="form-control @error('producto.rubro_id') is-invalid" @enderror name="rubros"
                            id="rubros" wire:model.defer="producto.rubro_id">
                            <option value="">Seleccione un rubro</option>
                            @foreach ($rubros as $rubro)
                            <option value="{{ $rubro->id }}">{{ $rubro->nombre }}</option>
                            @endforeach
                        </select>
                        @error('producto.rubro_id') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="col-sm-7">
                    <div class="form-group">
                        <!--input for nombre-->
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control @error('producto.nombre') is-invalid @enderror"
                            placeholder="Nombre" wire:model.defer="producto.nombre">
                        @error('producto.nombre') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <!--textarea for detalle-->
                        <label for="detalle">Detalle</label>
                        <textarea class="form-control" name="detalle" wire:model.defer="producto.detalle" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <!--checkbox for activo-->
                        <label for="activo">Activo</label>
                        <input type="checkbox" wire:model.defer="activo" class="form-control" style="max-width: 30px">
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.productos.index') }}"
                        class="btn btn-secondary ml-2 float-right">Cancelar</a>

                    <button wire:click="guardar" class="btn btn-primary float-right">
                        @if($modeNew)
                        Crear Producto
                        @else
                        Guardar
                        @endif
                    </button>


                </div>
            </div>
        </div>
    </div>

</div>
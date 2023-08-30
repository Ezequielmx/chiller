<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-user-tie" aria-hidden="true"></i>&nbsp;
                        @if($modeNew)
                        Nuevo Cliente
                        @else
                        Editar Cliente
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
                        <input type="text" class="form-control" disabled value={{ $modeNew? '' : $cliente->id }}>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="razon_social">Razón Social</label>
                        <input type="text" class="form-control @error('cliente.razon_social') is-invalid @enderror"
                            placeholder="Razón Social" wire:model.defer="cliente.razon_social">
                        @error('cliente.razon_social')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="cuit">CUIT</label>
                        <input type="text" class="form-control @error('cliente.cuit') is-invalid @enderror" placeholder="CUIT"
                            wire:model.defer="cliente.cuit">
                        @error('cliente.cuit')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="contacto">Contacto</label>
                        <input type="text" class="form-control @error('cliente.contacto') is-invalid @enderror"
                            placeholder="Contacto" wire:model.defer="cliente.contacto">
                        @error('cliente.contacto')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control @error('cliente.direccion') is-invalid @enderror"
                            placeholder="Dirección" wire:model.defer="cliente.direccion">
                        @error('cliente.direccion')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control @error('cliente.telefono') is-invalid @enderror"
                            placeholder="Teléfono" wire:model.defer="cliente.telefono">
                        @error('cliente.telefono')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('cliente.email') is-invalid @enderror" placeholder="Email"
                            wire:model.defer="cliente.email">
                        @error('cliente.email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
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
                    <a href="{{ route('admin.clientes.index') }}"
                        class="btn btn-secondary ml-2 float-right">Cancelar
                    </a>
                    <button wire:click="guardar" class="btn btn-primary float-right">
                        @if($modeNew)
                        Crear Cliente
                        @else
                        Guardar
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
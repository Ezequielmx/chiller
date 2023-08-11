<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-list-ul" aria-hidden="true"></i>&nbsp;Rubros</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createRubro">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control @error('newNombre') is-invalid @enderror"
                                placeholder="Nombre" wire:model.defer="newNombre">
                            @error('newNombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" class="form-control @error('newDetalle') is-invalid @enderror"
                                placeholder="Detalle" wire:model.defer="newDetalle">
                            @error('newDetalle')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <table class="table table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Detalle</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rubros as $rubro)
                    <tr>
                        <td style="width: 20%">
                            @if ($editing_id == $rubro->id)
                            <input type="text" wire:model="nombre" class="form-control">
                            @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @else
                            {{ $rubro->nombre }}
                            @endif
                        </td>
                        <td style="width: 70%">
                            @if ($editing_id == $rubro->id)
                            <input type="text" wire:model="detalle" class="form-control">
                            @else
                            {{ $rubro->detalle }}
                            @endif
                        </td>
                        <td style="white-space: nowrap; width: 10px">
                            @if ($editing_id == $rubro->id)
                            <button wire:click="updateRub({{ $rubro->id }})" class="btn btn-success btn-sm mr-1"><i
                                    class="fa fa-check"></i></button>
                            <button wire:click="editClose()" class="btn btn-danger btn-sm"><i
                                    class="fa fa-times"></i></button>
                            @else
                            <button wire:click="editing({{ $rubro->id }})" class="btn btn-primary btn-sm mr-1"><i
                                    class="fa fa-edit"></i></button>

                            <button wire:click="$emit('deleteRub',{{ $rubro->id }})" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
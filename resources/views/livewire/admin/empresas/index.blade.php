<div class="pt-2">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3><i class="fas fa-industry" aria-hidden="true"></i>&nbsp;Empresas</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Razón Social</th>
                        <th>CUIT</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->id }}</td>
                        <td>
                            @if ($editing_id == $empresa->id)
                            <input type="text" wire:model="razon_social" class="form-control">
                            @error('razon_social')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @else
                            {{ $empresa->razon_social }}
                            @endif
                        </td>
                        <td style="white-space: nowrap">
                            @if ($editing_id == $empresa->id)
                            <input type="text" wire:model="cuit" class="form-control">
                            @error('cuit')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @else
                            {{ $empresa->cuit }}
                            @endif
                        </td>
                        <td>
                            @if ($editing_id == $empresa->id)
                            <input type="text" wire:model="direccion" class="form-control">
                            @error('direccion')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @else
                            {{ $empresa->direccion }}
                            @endif
                        </td>
                        <td>
                            @if ($editing_id == $empresa->id)
                            <input type="text" wire:model="telefono" class="form-control">
                            @error('telefono')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @else
                            {{ $empresa->telefono }}
                            @endif
                        </td>
                        <td>
                            @if ($editing_id == $empresa->id)
                            <input type="text" wire:model="email" class="form-control">
                            @else
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>                                
                            @enderror
                            {{ $empresa->email }}
                            @endif
                        </td>
                        <td style="white-space: nowrap">
                            @if ($editing_id == $empresa->id)
                            <button wire:click="updateEmp({{ $empresa->id }})" class="btn btn-success btn-sm mr-1"><i
                                    class="fa fa-check"></i></button>
                            <button wire:click="editClose()" class="btn btn-danger btn-sm"><i
                                    class="fa fa-times"></i></button>
                            @else
                            <button wire:click="editing({{ $empresa->id }})" class="btn btn-primary btn-sm mr-1"><i
                                    class="fa fa-edit"></i></button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
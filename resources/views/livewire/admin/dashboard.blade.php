<div class="pt-2">
    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label for="periodo" class="col-sm-2 col-12 col-form-label">Periodo:</label>
                <div class="col-sm-4 col-12">
                    <select class="form-control" name="periodo" wire:model="periodo">
                        <option value="hoy">Hoy</option>
                        <option value="ultima_semana">Última semana</option>
                        <option value="ultimo_mes">Último mes</option>
                        <option value="ultimo_anio">Último año</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <div class="row">
                                <div class="col">
                                    <span>Órdenes Realizadas:</span>
                                    <h3>{{ $ordenes->count()}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-fw fa-file-invoice-dollar"></i>
                        </div>
                        <a href="{{ route('admin.ordenes.index') }}" class="small-box-footer">ÓRDENES REALIZADAS
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <div class="row">
                                <div class="col">
                                    <span>Órdenes en Borrador:</span>
                                    <h3>{{ $ordenes->where('estado_id','=',1)->count()}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-fw fa-pencil-alt"></i>
                        </div>
                        <a href="{{ route('admin.ordenes.index') }}" class="small-box-footer">ÓRDENES EN BORRADOR
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <div class="row">
                                <div class="col">
                                    <span>Órdenes Enviadas:</span>
                                    <h3>{{ $ordenes->where('estado_id','=',2)->count()}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-fw fa-paper-plane"></i>
                        </div>
                        <a href="{{ route('admin.ordenes.index') }}" class="small-box-footer">ÓRDENES ENVIADAS
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <div class="row">
                                <div class="col">
                                    <span>Órdenes Retiradas:</span>
                                    <h3>{{ $ordenes->where('estado_id','=',3)->count()}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-fw fa-truck"></i>
                        </div>
                        <a href="{{ route('admin.ordenes.index') }}" class="small-box-footer">ÓRDENES RETIRADAS
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <div class="row">
                                <div class="col">
                                    <span>Órdenes Cerradas:</span>
                                    <h3>{{ $ordenes->where('estado_id','=',4)->count()}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-fw fa-check-circle"></i>
                        </div>
                        <a href="{{ route('admin.ordenes.index') }}" class="small-box-footer">ÓRDENES CERRADAS
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
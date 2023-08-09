<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('codigo', 'Código') !!}
            {!! Form::text('codigo', null, ['class'=>'form-control']) !!}
            @error('codigo')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('razon_social', 'Razón Social') !!}
            {!! Form::text('razon_social', null, ['class'=>'form-control']) !!}
            @error('razon_social')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('cuit', 'CUIT') !!}
            {!! Form::text('cuit', null, ['class'=>'form-control']) !!}
            @error('cuit')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('contacto', 'Contacto') !!}
            {!! Form::text('contacto', null, ['class'=>'form-control']) !!}
            @error('contacto')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            {!! Form::label('direccion', 'Dirección') !!}
            {!! Form::text('direccion', null, ['class'=>'form-control']) !!}
            @error('direccion')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('telefono', 'Teléfono') !!}
            {!! Form::text('telefono', null, ['class'=>'form-control']) !!}
            @error('telefono')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class'=>'form-control']) !!}
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('web', 'Web') !!}
            {!! Form::text('web', null, ['class'=>'form-control']) !!}
            @error('web')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('forma_pago_id', 'Forma de Pago') !!}
            {!! Form::select('forma_pago_id', $formasPago, null, ['class'=>'form-control']) !!}
            @error('forma_pago_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-2">

        {!! Form::label('activo', 'Activo') !!}
        <div class="form-check form-switch">
                @isset($proveedore)
                    @if ($proveedore->activo == 0)
                        {!! Form::checkbox('activo', null, null) !!}
                    @else
                        {!! Form::checkbox('activo', null, 'checked') !!}
                    @endif
                @else
                    {!! Form::checkbox('activo', null, 'checked') !!}
                @endisset
        </div>
    </div>
</div>
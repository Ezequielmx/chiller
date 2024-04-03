<!DOCTYPE html>
<html>
@php
setlocale(LC_TIME, "spanish");
@endphp

<head>
    <title>Cotización qqq</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            font-size: 13px;
            font-weight: 400;
        }

        .container {
            width: 700px;
            margin: auto;
            border: 1px solid black;
        }

        .logo-cell {
            width: 300px;
        }

        .logo {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .header-text {
            width: 30%;
            text-align: right;
        }

        .header-text p {
            font-size: 12px;
            margin: 3px;
            text-align: left;
        }

        table {
            border-spacing: 0px;
        }

        h3,
        h2,
        h1 {
            font-weight: 400;
        }

        h3 {
            font-size: 14px;
            margin: 0;
        }

        h2 {
            font-size: 16px;
        }

        td {
            padding: 5px;
            border: 1px solid black;
        }


        .table-striped {
            width: 100%;
            border-collapse: collapse;
            /*margin-bottom: 1rem;*/
        }

        .ths,
        .tds {
            padding: 0.4rem;
            text-align: left;
            vertical-align: top;
            /*border-top: 1px solid #dee2e6;*/
            font-size: 12px;
            vertical-align: middle;
            border: 1px solid black;
        }

        .ths {
            background-color: #f8f9fa;
        }

        .table-striped tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <table style="width: 100%;">
            <tr>
                <td class="logo-cell" style="width: 20%">
                    <img src="{{ asset('img/logo' . $orden->empresa->id .'.png') }}" alt="Logo" class="logo">
                </td>

                <td class="header-text" style="width: 60%">
                    <p><b>{{ $orden->empresa->razon_social }}</b></p>
                    <p>CUIT {{ $orden->empresa->cuit }}</p>
                    <p>{{ $orden->empresa->direccion }}</p>
                    <p>Tel: {{ $orden->empresa->telefono }} - Email: {{ $orden->empresa->email }}</p>
                </td>

                <td style="width: 20%; padding:0">
                    <table style="width: 100%; text-align: right;">
                        <tr>
                            <td style="height: 35px">
                                <h3>Fecha: <b>{{ date('d/m/Y', strtotime($orden->fecha)) }}</b></h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 35px">
                                <h3>Orden Nro: <b>{{ $orden->nro }}</b></h3>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2>Poveedor: <b>{{ $orden->proveedor->razon_social }}</b></h2>
                </td>
                <td>
                    <h3>Forma de pago: <b>{{ $orden->forma_pago->descripcion }}</b></h3>
                </td>
            </tr>
        </table>

        <table class="table-striped">
            <thead>
                <th class="ths" style="width: 20%;">Cantidad</th>
                <th class="ths">Producto</th>
                <th class="ths">Precio</th>
            </thead>
            <tbody>
                @foreach ($orden->detalles as $detalle)
                <tr>
                    <td class="tds">{{ $detalle->cantidad }} {{ $detalle->unidad->nombre }}</td>
                    <td class="tds">{{ $detalle->producto->nombre }}</td>
                    <td class="tds" style="text-align: right;">${{ number_format($detalle->precio, 2, ',', '.') }}</td>
                </tr>
                @endforeach
                <!-- fila de total con suma de precios -->
                <tr>
                    <td class="tds" colspan="2" style="text-align: right;">
                        <h3>Total:</h3>
                    </td>
                    <td class="tds" style="text-align: right;">
                        <h3><b>${{ number_format($orden->detalles->sum('precio'), 2, ',', '.') }}</h3></b>
                    </td>
                        
                </tr>
            </tbody>
        </table>

        <table style="width:100%">
            <td style="width: 35%">
                <h3>Retira: <b>{{ $orden->retira? $orden->retira : '' }}</b></h3>
                <hr>
                <h3>Cliente: <b>{{ $orden->obra->cliente->razon_social }}</b></h3>
                <h3>Obra: <b>{{ $orden->obra->nombre }}</b></h3>
                <h3>Presupuesto: <b>{{ $orden->obra->presupuesto }}</b></h3>  
            </td>
            <td style="width: 25%">
                Autorizó
                <h3><b>{{ $orden->user_solic? $orden->user_solic->name : '' }}</b></h3>
                <hr>
                Confeccionó
                <h3><b>{{ $orden->user->name }}</b></h3>
            </td>
            <td style="width: 25%">
                V.B.
                <h3><b>{{ $orden->user_aut? $orden->user_aut->name : '' }}</b></h3>
            </td>
            <td style="width: 15%">
                Factura N°
                <h3><b>{{ $orden->factura}}</b></h3>
            </td>
        </table>        
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Guía de Remisión Electrónica - #{{ $traslado->id_traslado }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .header-section,
        .info-section {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .header-section p,
        .info-section p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <h1>Guía de Remisión Electrónica</h1>

    <!-- Encabezado de la empresa -->
    <div class="header-section">
        <p><strong>RUC:</strong> 20412345678</p>
        <p><strong>Razón Social:</strong> Nombre de la Empresa S.A.</p>
        <p><strong>Dirección:</strong> Calle Falsa 123, Lima, Perú</p>
    </div>

    <!-- Información del traslado -->
    <div class="info-section">
        <p><strong>Número de Guía:</strong> {{ $traslado->guia }}</p>
        <p><strong>Placa del Vehículo:</strong> {{ $traslado->placa_vehiculo }}</p>
        <p><strong>Almacén de Salida:</strong> {{ $traslado->almacenSalida->nombre }}</p>
        <p><strong>Almacén de Entrada:</strong> {{ $traslado->almacenEntrada->nombre }}</p>
        <p><strong>Motivo:</strong> {{ $traslado->motivo }}</p>
        <p><strong>Usuario:</strong> {{ $traslado->usuario->name }}</p>
        <p><strong>Fecha:</strong> {{ $traslado->created_at->format('d-m-Y') }}</p>
    </div>

    <!-- Detalle de productos -->
    <h2 style="margin-top: 20px; color: #4CAF50;">Detalle de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Unidad de Medida</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->codigo }}</td>
                    <td>{{ $detalle->producto }}</td>
                    <td>{{ $detalle->unidad_medida }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

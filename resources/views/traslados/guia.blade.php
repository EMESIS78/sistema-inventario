<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guía de Remisión - #{{ $traslado->id_traslado }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Guía de Remisión</h1>
    <p><strong>Número de Guía:</strong> {{ $traslado->guia }}</p>
    <p><strong>Placa del Vehículo:</strong> {{ $traslado->placa_vehiculo }}</p>
    <p><strong>Almacén de Salida:</strong> {{ $traslado->almacenSalida->nombre }}</p>
    <p><strong>Almacén de Entrada:</strong> {{ $traslado->almacenEntrada->nombre }}</p>
    <p><strong>Motivo:</strong> {{ $traslado->motivo }}</p>
    <p><strong>Usuario:</strong> {{ $traslado->usuario->name }}</p>
    <p><strong>Fecha:</strong> {{ $traslado->created_at->format('d-m-Y') }}</p>

    <h2>Productos:</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Traslados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 14px;
        }
        h2 {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
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
        .footer {
            text-align: right;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Reporte de Traslados</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Almacén de Salida</th>
                <th>Almacén de Entrada</th>
                <th>Usuario</th>
                <th>Motivo</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($traslados as $traslado)
                <tr>
                    <td>{{ $traslado->id_traslado }}</td>
                    <td>{{ $traslado->almacenSalida->nombre }}</td>
                    <td>{{ $traslado->almacenEntrada->nombre }}</td>
                    <td>{{ $traslado->usuario->name }}</td>
                    <td>{{ $traslado->motivo }}</td>
                    <td>{{ $traslado->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>Reporte generado el {{ now()->format('d-m-Y H:i') }}</p>
    </div>
</body>
</html>

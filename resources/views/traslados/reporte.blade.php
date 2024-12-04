<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Traslados</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
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
                    <td>{{ $traslado->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

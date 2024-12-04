<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Salidas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Reporte de Salidas</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Almacén</th>
                <th>Motivo</th>
                <th>Usuario</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salidas as $salida)
                <tr>
                    <td>{{ $salida->id_salida }}</td>
                    <td>{{ $salida->almacen_nombre }}</td>
                    <td>{{ $salida->motivo }}</td>
                    <td>{{ $salida->usuario_nombre }}</td>
                    <td>{{ $salida->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

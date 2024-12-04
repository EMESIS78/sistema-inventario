<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Entradas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Reporte de Entradas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Documento</th>
                <th>Almacén</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entradas as $entrada)
                <tr>
                    <td>{{ $entrada->id_entrada }}</td>
                    <td>{{ $entrada->documento }}</td>
                    <td>{{ $entrada->almacen->nombre }}</td>
                    <td>{{ $entrada->id_proveedor }}</td>
                    <td>{{ $entrada->created_at->format('d-m-Y') }}</td>
                    <td>{{ $entrada->usuario->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

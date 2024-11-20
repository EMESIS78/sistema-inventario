<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Inventario</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Reporte de Inventario</h1>
    <table>
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Ubicación</th>
                <th>Stock</th>
                <th>Almacén</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reporte as $item)
                <tr>
                    <td>{{ $item->id_producto }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->marca }}</td>
                    <td>{{ $item->ubicacion }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->nombre_almacen }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

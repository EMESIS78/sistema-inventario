<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Kardex Valorado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Kardex Valorado</h1>
    <p><strong>Fecha Inicio:</strong> {{ $fechaInicio ?? 'No especificada' }}</p>
    <p><strong>Fecha Fin:</strong> {{ $fechaFin ?? 'No especificada' }}</p>
    <p><strong>Búsqueda de Producto:</strong> {{ $buscarProducto ?? 'No especificada' }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Documento</th>
                <th>Precio Unitario</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kardexValorado as $item)
                <tr>
                    <td>{{ $item->producto }}</td>
                    <td>{{ $item->documento }}</td>
                    <td>{{ number_format($item->precio_unitario, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->fecha)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No se encontraron resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>